<?php

namespace LCStudios\QACommandBundle\Command;

use LCStudios\MetaCommandBundle\Console\ExternalCommand;
use Symfony\Component\Console\Input\InputInterface;

class PhpUnitCommand extends ExternalCommand
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('qa:phpunit')
            ->setDescription('Runs the PHPUnit tests.');
    }


    protected function getCommand(InputInterface $input)
    {
        $kernel = $this->getContainer()->get('kernel');
        $appPath = $kernel->getRootDir();

        $phpUnit = $appPath.'/../bin/phpunit';

        $command = 'php '.$phpUnit.' -c '.$appPath;

        return $command;
    }
}
