<?php

namespace DDM\SRIIntegrityHash\Command;

use DDM\SRIIntegrityHash\FileReader;
use DDM\SRIIntegrityHash\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @codeCoverageIgnore
 */
class GeneratorCommand extends Command
{
    protected static $defaultName = "generate";
    protected function configure()
    {
        $this->setDescription('Generates a JSON assets map');
        $this->addOption('file', 'f', InputOption::VALUE_REQUIRED + InputOption::VALUE_IS_ARRAY, 'File to be included in assets map', []);
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generator = new Generator();
        foreach ($input->getOption('file') as $file) {
            $generator->read(new FileReader(), $file);
        }
        $output->write($generator->toJSON());
    }
}
