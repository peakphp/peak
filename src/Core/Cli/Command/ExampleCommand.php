<?php

namespace Core\Cli\Command;

use Peak\Common\Chrono\Chrono;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ExampleCommand extends Command
{
    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('example')

            // the short description shown while running "php bin/console list"
            ->setDescription('example command')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('example help')

            ->setDefinition(new InputDefinition([
                    new InputOption('test', 't', InputOption::VALUE_NONE, 'test mode'),
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

        // do something

        $output->writeln('Done! > '.$chrono->getMs(4).' ms');
    }
}
