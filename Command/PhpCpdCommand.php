<?php

namespace LCStudios\QACommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PhpCpdCommand extends ContainerAwareCommand
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('qa:phpcpd')
            ->setDescription('Runs the PHPCPD utility.');
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $kernel = $this->getContainer()->get('kernel');
        $appPath = $kernel->getRootDir();

        $capturedOutput = array();
        $returnStatus = 0;

        $phpCpd = $appPath.'/../bin/phpcpd' ;
        $command = $phpCpd.' --log-pmd '.$appPath.'/../build/logs/pmd-cpd.xml '.$appPath.'/../src';

        exec($command, $capturedOutput, $returnStatus);

        if (OutputInterface::VERBOSITY_VERBOSE <= $output->getVerbosity()) {
            $output->writeln($command);
        }
        if (OutputInterface::VERBOSITY_QUIET <= $output->getVerbosity()) {
            $output->writeln(implode(PHP_EOL, $capturedOutput));
        }

        if ($returnStatus > 0) {
            return 1;
        }

        return 0;
    }
}
