<?php

namespace DDM\SRIIntegrityHash\Command;

use DDM\SRIIntegrityHash\FileReader;
use DDM\SRIIntegrityHash\FileReaderOptions;
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
        $this->addOption('ignore-ssl', 's', InputOption::VALUE_NONE, 'Ignore SSL verification');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generator = new Generator();
        $fileReaderOptions = new FileReaderOptions();
        $fileReaderOptions->setSslVerify(!$input->getOption('ignore-ssl'));
        var_dump($fileReaderOptions);
        foreach ($input->getOption('file') as $file) {
            $generator->read(new FileReader(), $file, $fileReaderOptions);
        }
        $output->write($generator->toJSON());
    }
}
