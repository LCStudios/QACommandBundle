<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 05.10.13
 * Time: 15:47
 */

namespace LCStudios\QACommandBundle\Command;


use LCStudios\MetaCommandBundle\Console\MetaCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

class QARunCommand extends MetaCommand
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('qa:run')
            ->setDescription('Runs all QA tasks.')
            ->addOption(
                'ci',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will save the result as XML to the build directory.'
            );
    }

    public function getCommandArray(InputInterface $input)
    {
        return [
            'phploc' => ['command' => 'qa:phploc'],
            'pdepend' => ['command' => 'qa:pdepend'],
            'phpmd' => [
                'command' => 'qa:phpmd',
                '--ci' => $input->getOption('ci')
            ],
            'phpcs' => [
                'command' => 'qa:phpcs',
                '--ci' => $input->getOption('ci')
            ],
            'phpcpd' => ['command' => 'qa:phpcpd'],
            'phpunit' => ['command' => 'qa:phpunit'],
            'phpcb' => ['command' => 'qa:phpcb'],
        ];
    }
}
