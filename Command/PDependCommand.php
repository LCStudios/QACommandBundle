<?php

namespace LCStudios\QACommandBundle\Command;

use LCStudios\MetaCommandBundle\Console\ExternalCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PDependCommand extends ExternalCommand
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('qa:pdepend')
            ->setDescription('Runs the PDepend utility.');
    }

    protected function getCommand(InputInterface $input)
    {
        $kernel = $this->getContainer()->get('kernel');
        $appPath = $kernel->getRootDir();

        $phpCs = $appPath.'/../bin/pdepend';
        $command = $phpCs.' --jdepend-xml='.$appPath.'/../build/logs/jdepend.xml '.
            '--jdepend-chart='.$appPath.'/../build/pdepend/dependencies.svg '.
            '--overview-pyramid='.$appPath.'/../build/pdepend/overview-pyramid.svg '.
            $appPath.'/../src';

        return $command;
    }
}
