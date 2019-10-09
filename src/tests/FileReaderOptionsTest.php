<?php

namespace DDM\SRIIntegrityHash\Tests;

use DDM\SRIIntegrityHash\FileReaderOptions;
use PHPUnit\Framework\TestCase;

class FileReaderOptionsTest extends TestCase
{
    public function testSslDefaultsToVerify()
    {
        $fileReaderOptions = new FileReaderOptions();

        $this->assertIsArray($fileReaderOptions->toArray());
        $this->assertArrayHasKey('ssl', $fileReaderOptions->toArray());
        $this->assertIsArray($fileReaderOptions->toArray()['ssl']);
        $this->assertArrayHasKey('verify_peer', $fileReaderOptions->toArray()['ssl']);
        $this->assertIsBool($fileReaderOptions->toArray()['ssl']['verify_peer']);
        $this->assertTrue($fileReaderOptions->toArray()['ssl']['verify_peer']);
        $this->assertArrayHasKey('verify_peer_name', $fileReaderOptions->toArray()['ssl']);
        $this->assertIsBool($fileReaderOptions->toArray()['ssl']['verify_peer_name']);
        $this->assertTrue($fileReaderOptions->toArray()['ssl']['verify_peer_name']);
    }
    public function testSslVerifyFalse()
    {
        $fileReaderOptions = new FileReaderOptions();

        $fileReaderOptions->setSslVerify(false);

        $this->assertIsArray($fileReaderOptions->toArray());
        $this->assertArrayHasKey('ssl', $fileReaderOptions->toArray());
        $this->assertIsArray($fileReaderOptions->toArray()['ssl']);
        $this->assertArrayHasKey('verify_peer', $fileReaderOptions->toArray()['ssl']);
        $this->assertIsBool($fileReaderOptions->toArray()['ssl']['verify_peer']);
        $this->assertFalse($fileReaderOptions->toArray()['ssl']['verify_peer']);
        $this->assertArrayHasKey('verify_peer_name', $fileReaderOptions->toArray()['ssl']);
        $this->assertIsBool($fileReaderOptions->toArray()['ssl']['verify_peer_name']);
        $this->assertFalse($fileReaderOptions->toArray()['ssl']['verify_peer_name']);
    }
}
