<?php

namespace DDM\SRIIntegrityHash\Tests;

use DDM\SRIIntegrityHash\File;
use DDM\SRIIntegrityHash\FileReader;
use DDM\SRIIntegrityHash\FileReaderOptions;
use PHPUnit\Framework\TestCase;
use Mockery;

function file_get_contents(...$args)
{
    var_dump($args);
}

class FileReaderTest extends TestCase
{
    public function testReadWithoutSsl()
    {
        // $fileReader = new FileReader();
        $filename = __DIR__ . '/fixture-script.js';


        $options = new FileReaderOptions();

        $mock = Mockery::mock(FileReader::class)->makePartial();
        $mock->shouldReceive('fileGetContents')->once()->with($filename, $options->toArray())->andReturn('fake-file-contents');
        $result = $mock->read($filename, $options);
        $this->assertInstanceOf(File::class, $result);
        $this->assertEquals('fake-file-contents', $result->data);

        $this->assertNotEmpty($result);
    }
}
