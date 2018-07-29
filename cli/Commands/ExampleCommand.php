<?php

namespace Cli\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ExampleCommand
 * @package Cli\Commands
 */
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
            ->setDescription('Example command description')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Help about example command...');
    }

    /**
     * Execute command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'That\'s it!!!',
            '============',
        ]);
    }
}
