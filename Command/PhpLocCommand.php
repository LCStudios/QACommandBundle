<?php

namespace LCStudios\QACommandBundle\Command;

use LCStudios\MetaCommandBundle\Console\ExternalCommand;
use Symfony\Component\Console\Input\InputInterface;

class PhpLocCommand extends ExternalCommand
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('qa:phploc')
            ->setDescription('Runs the PHPLOC utility.');
    }


    protected function getCommand(InputInterface $input)
    {
        $kernel = $this->getContainer()->get('kernel');
        $appPath = $kernel->getRootDir();
        $phpLoc = $appPath.'/../bin/phploc' ;
        $command = $phpLoc.' --log-csv build/logs/phploc.csv '.$appPath.'/../src ';

        return $command;
    }
}
