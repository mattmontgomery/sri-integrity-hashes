<?php

namespace DDM\SRIIntegrityHash\Tests;

use DDM\SRIIntegrityHash\Loaders;
use DDM\SRIIntegrityHash\Loader;
use DDM\SRIIntegrityHash\File;
use PHPUnit\Framework\TestCase;

class LoadersTest extends TestCase
{
    public $fixturePath = __DIR__ . "/fixture-loader.json";
    public $fixturePathSecondary = __DIR__ . "/fixture-loader2.json";
    public function testLoadersWithSingleRegistered()
    {
        $loaders = new Loaders();
        $loaders->register(new Loader($this->fixturePath));

        $file = $loaders->getFile($this->fixturePath, "test-script.js");
        $this->assertInstanceOf(File::class, $file);
        $this->assertIsString('string', $file->toScript());

        $file = $loaders->getFile($this->fixturePath, "test-script-2.js");
        $this->assertInstanceOf(File::class, $file);
        $this->assertIsString('string', $file->toScript());
        $this->assertIsArray($loaders->getFiles());
        $this->assertCount(2, $loaders->getFiles());
    }
    public function testLoadersWithAutoRegistered()
    {
        $loaders = new Loaders();

        $file = $loaders->getFile($this->fixturePath, "test-script.js");
        $this->assertInstanceOf(File::class, $file);
        $this->assertIsString('string', $file->toScript());

        $file = $loaders->getFile($this->fixturePath, "test-script-2.js");
        $this->assertInstanceOf(File::class, $file);
        $this->assertIsString('string', $file->toScript());
        $this->assertIsArray($loaders->getFiles());
        $this->assertCount(2, $loaders->getFiles());
    }
    public function testLoadersWithMultipleRegistered()
    {
        $loaders = new Loaders();
        $loaders->register(new Loader($this->fixturePath));
        $loaders->register(new Loader($this->fixturePathSecondary));

        $file = $loaders->getFile($this->fixturePath, "test-script.js");
        $this->assertInstanceOf(File::class, $file);
        $this->assertIsString('string', $file->integrity);
        $this->assertEquals("sha512-test", $file->integrity);
        $this->assertIsString('string', $file->source);
        $this->assertIsString('string', $file->toScript());


        $file = $loaders->getFile($this->fixturePath, "test-script-2.js");
        $this->assertInstanceOf(File::class, $file);
        $this->assertIsString('string', $file->integrity);
        $this->assertEquals("sha512-test", $file->integrity);
        $this->assertIsString('string', $file->source);
        $this->assertIsString('string', $file->toScript());

        $file = $loaders->getFile($this->fixturePathSecondary, "test-script.js");
        $this->assertInstanceOf(File::class, $file);
        $this->assertRegExp("/banana$/i", $file->integrity);
        $this->assertIsString('string', $file->source);
        $this->assertIsString('string', $file->toScript());


        $file = $loaders->getFile($this->fixturePathSecondary, "test-script-2.js");
        $this->assertInstanceOf(File::class, $file);
        $this->assertIsString('string', $file->integrity);
        $this->assertRegExp("/banana$/i", $file->integrity);
        $this->assertIsString('string', $file->source);
        $this->assertIsString('string', $file->toScript());

        $this->assertIsArray($loaders->getFiles());
        $this->assertCount(4, $loaders->getFiles());
    }
    public function testLoaderesReturnsNullOnNotFoundFile()
    {
        $loaders = new Loaders();
        $loaders->register(new Loader($this->fixturePath));
        $this->assertNull($loaders->getFile($this->fixturePath, "spec.js"));
    }
}
