<?php

require_once __DIR__ . '/../vendor/autoload.php';

use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;
use DDM\SRIIntegrityHash\Generator;
use DDM\SRIIntegrityHash\FileReader;


class GeneratorCLI extends CLI
{
    protected function setup(Options $options)
    {
    }
    protected function main(Options $options)
    {
        $generator = new Generator();
        foreach ($options->getArgs() as $file) {
            $generator->read(new FileReader(), $file);
        }
        echo $generator->toJSON();
    }
}

$cli = new GeneratorCLI();
$cli->run();