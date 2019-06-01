<?php

namespace Core\Cli\Command;

use Peak\Common\Chrono\Chrono;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CodeGeneratorCommand extends Command
{
    /**
     * @var array
     */
    private $templates = [
        'handler' => [
            'template' => __DIR__.'/CodeGenerator/Handler.tpl',
            'defaultNs' => 'Core\Http\Handler'
        ],
        'middleware' => [
            'template' => __DIR__.'/CodeGenerator/Middleware.tpl',
            'defaultNs' => 'Core\Http\Middleware'
        ]
    ];

    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('codegen')

            // the short description shown while running "php bin/console list"
            ->setDescription('Code Generator Command')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Code Generator Command')

            ->setDefinition(new InputDefinition([
                    new InputOption('template', 't', InputOption::VALUE_REQUIRED, 'Current templates: ['.implode(', ', array_keys($this->templates)).']'),
                    new InputOption('namespace', null, InputOption::VALUE_REQUIRED, ''),
                    new InputArgument('classname')
                ])
            );
    }

    /**
     * Execute the command
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $chrono = new Chrono();

        $templateName = strtolower($input->getOption('template'));
        $namespace = $input->getOption('namespace');
        $className = $input->getArgument('classname');

        if (empty($className)) {
            $output->writeln('Please, specify a class name');
            return;
        }

        if (empty($templateName)) {
            $output->writeln('Please, specify class template with -t. Current templates: ['.implode(', ', array_keys($this->templates)).']');
            return;
        }

        if (!is_string($templateName) || !array_key_exists($templateName, $this->templates)) {
            $output->writeln('No template found for ['.$templateName.']');
            return;
        }

        if (empty($namespace)) {
            $namespace = $this->templates[$templateName]['defaultNs'];
        }

        $templateFile = $this->templates[$templateName]['template'];
        $templateContent = file_get_contents($templateFile);
        $finalContent = interpolate($templateContent, [
            'namespace' => $namespace,
            'classname' => $className,
        ]);

        $destinationPath = PROJECT_PATH.'/src/'.str_replace('\\','/', $namespace);
        $filename = $className.'.php';
        $destinationFile = $destinationPath.'/'.$filename;

        if (file_exists($destinationFile)) {
            $output->writeln('The file ['.$destinationFile.'] already exists!');
            return;
        }

        $result = @file_put_contents($destinationFile, $finalContent);

        if ($result === false) {
            $output->writeln('Unable to write file ['.$destinationFile.'] ...');

            if (!file_exists(dirname($destinationFile))) {
                $output->writeln('Folder ['.dirname($destinationFile).'] doesn\'t exists...');
            }
            return;
        }

        $output->writeln('Created '.$destinationPath.'/'.$filename);
        $output->writeln('Done! > '.$chrono->getMs(4).' ms');
    }
}
