<?php

namespace LCStudios\QACommandBundle\Command;

use LCStudios\MetaCommandBundle\Console\ExternalCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PhpCsCommand extends ExternalCommand
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('qa:phpcs')
            ->setDescription('Runs the PHPCS utility.')
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

        $phpCs = $appPath.'/../bin/phpcs' ;
        $command = $phpCs.' --standard='.$appPath.'/../ruleset.xml --extensions=php';

        if ($input->getOption('ci')) {
            $command .= ' --report=checkstyle --report-file='.$appPath.'/../build/logs/checkstyle.xml';
        }

        $command .= ' '.$appPath.'/../src';

        return $command;
    }
}
