<?php

namespace LCStudios\QACommandBundle\Command;

use LCStudios\MetaCommandBundle\Console\ExternalCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PhpMdCommand extends ExternalCommand
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('qa:phpmd')
            ->setDescription('Runs the PHPMD utility.')
            ->addOption(
                'ci',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will save the result as XML to the build directory.'
            );
    }


    protected function getCommand(InputInterface $input)
    {
        $kernel = $this->getContainer()->get('kernel');
        $appPath = $kernel->getRootDir();

        $phpMd = $appPath.'/../bin/phpmd' ;
        $command = $phpMd.' '.$appPath.'/../src ';

        if ($input->getOption('ci')) {
            $command .= 'xml '.$appPath.'/../phpmd.xml --reportfile '.$appPath.'/../build/logs/pmd.xml';
        } else {
            $command .= 'text '.$appPath.'/../phpmd.xml';
        }

        return $command;
    }
}
