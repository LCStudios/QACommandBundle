<?php

namespace LCStudios\QACommandBundle\Command;

use LCStudios\MetaCommandBundle\Console\ExternalCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PhpCbCommand extends ExternalCommand
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('qa:phpcb')
            ->setDescription('Runs the PHPMD utility.');
    }


    protected function getCommand(InputInterface $input)
    {
        $kernel = $this->getContainer()->get('kernel');
        $appPath = $kernel->getRootDir();

        $phpCb = $appPath.'/../bin/phpcb' ;
        $command = $phpCb.' --log '.$appPath.'/../build/logs --source '
            .$appPath.'/../src --output '.$appPath.'/../build/code-browser';

        return $command;
    }
}
