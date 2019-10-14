<?php

namespace DDM\SRIIntegrityHash\Tests;

use DDM\SRIIntegrityHash\Generator;
use DDM\SRIIntegrityHash\FileReader;
use DDM\SRIIntegrityHash\FileReaderOptions;
use DDM\SRIIntegrityHash\ReaderException;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    private $fixture =  __DIR__ . "/fixture-script.js";
    public function testGeneratorWithScript()
    {
        $generator = new Generator(['sha512', 'sha256', 'sha384', 'sha1']);
        $generator->read(new FileReader(), $this->fixture);
        $result = $generator->toJSON();
        $data = json_decode($result, true);
        $this->assertIsString($result);
        $this->assertIsArray($data);
        $this->assertNotEmpty($result);
        $this->assertNotEmpty($data);

        $this->assertRegExp("/sha512\-/i", $data[$this->fixture]['integrity']);
        $this->assertRegExp("/sha256\-/i", $data[$this->fixture]['integrity']);
        $this->assertRegExp("/sha384\-/i", $data[$this->fixture]['integrity']);
        $this->assertRegExp("/sha1\-/i", $data[$this->fixture]['integrity']);
    }
    public function testGeneratorPassesReadWithScript()
    {
        $generator = new Generator(['sha512', 'sha256', 'sha384', 'sha1']);
        $options = new FileReaderOptions();
        $generator->read(new FileReader(), $this->fixture, $options);
        $result = $generator->toJSON();
        $data = json_decode($result, true);
        $this->assertIsString($result);
        $this->assertIsArray($data);
        $this->assertNotEmpty($result);
        $this->assertNotEmpty($data);

        $this->assertRegExp("/sha512\-/i", $data[$this->fixture]['integrity']);
        $this->assertRegExp("/sha256\-/i", $data[$this->fixture]['integrity']);
        $this->assertRegExp("/sha384\-/i", $data[$this->fixture]['integrity']);
        $this->assertRegExp("/sha1\-/i", $data[$this->fixture]['integrity']);
    }
    public function testGeneratorWithBadFile()
    {
        $this->expectException(ReaderException::class);
        $this->expectExceptionMessage("THIS_FILE_DOES_NOT_EXIST");
        $generator = new Generator(['sha512', 'sha256', 'sha384', 'sha1']);
        $generator->read(new FileReader(), __DIR__ . "/THIS_FILE_DOES_NOT_EXIST");
    }
}
