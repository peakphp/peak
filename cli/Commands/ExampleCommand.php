<?php

namespace Cli\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExampleCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('example')

            // the short description shown while running "php bin/console list"
            ->setDescription('Example command description')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Help about example command...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'That\'s it!!!',
            '============',
        ]);
    }
}
