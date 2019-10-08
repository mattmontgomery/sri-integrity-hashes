<?php

namespace DDM\SRIIntegrityHash\Tests;

use DDM\SRIIntegrityHash\FileLoader as Loader;
use DDM\SRIIntegrityHash\LoaderException;
use DDM\SRIIntegrityHash\File;
use PHPUnit\Framework\TestCase;

class LoaderTest extends TestCase
{
    public $fixturePath = __DIR__ . "/fixture-loader.json";
    public function testLoaderCanBeImplementedAlone()
    {
        $loader = new Loader($this->fixturePath);
        $file = $loader->getFile("test-script.js");
        $this->assertInstanceOf(File::class, $file);
        $this->assertIsString('string', $file->toScript());

        $file = $loader->getFile("test-script-2.js");
        $this->assertInstanceOf(File::class, $file);
        $this->assertIsString('string', $file->integrity);
        $this->assertIsString('string', $file->source);
        $this->assertIsString('string', $file->toScript());


        $this->assertIsArray($loader->getFiles());
        $this->assertCount(2, $loader->getFiles());
    }
    public function testLoaderThrowsExceptionOnBadFile()
    {
        $this->expectException(LoaderException::class);
        $this->expectExceptionMessage("nothing-here.json does not exist or could not be read");
        $loader = new Loader("nothing-here.json");
    }
    public function testLoaderThrowsExceptionOnEmptyFile()
    {
        $this->expectException(LoaderException::class);
        $this->expectExceptionMessage("fixture-empty.txt does not include json data");
        $loader = new Loader(__DIR__ . "/fixture-empty.txt");
    }
}
