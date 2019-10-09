<?php

namespace DDM\SRIIntegrityHash\Tests;

use DDM\SRIIntegrityHash\File;

class FileTest extends \PHPUnit\Framework\TestCase
{
    public function testFileHashWithSingleAlgo()
    {
        $fixtureData = [
            'data' => "test-data"
        ];
        $fixtureData['sha512'] = base64_encode(hash('sha512', $fixtureData['data']));
        $fixtureData['sha512-hash'] = "sha512-{$fixtureData['sha512']}";
        $fixtureData['sha256'] = base64_encode(hash('sha256', $fixtureData['data']));
        $fixtureData['sha256-hash'] = "sha256-{$fixtureData['sha256']}";

        $file = new File();
        $file->data = $fixtureData['data'];
        $this->assertRegExp('/sha512\-/', $file->hash(['sha512']));
        $this->assertEquals("{$fixtureData['sha512-hash']}", $file->hash(['sha512']));
        $this->assertRegExp('/sha256\-/', $file->hash(['sha256']));
        $this->assertEquals("{$fixtureData['sha256-hash']}", $file->hash(['sha256']));
    }
    public function testFileHashWithMultipleAlgo()
    {
        $fixtureData = [
            'data' => "test-data"
        ];
        $fixtureData['sha512'] = base64_encode(hash('sha512', $fixtureData['data']));
        $fixtureData['sha512-hash'] = "sha512-{$fixtureData['sha512']}";
        $fixtureData['sha256'] = base64_encode(hash('sha256', $fixtureData['data']));
        $fixtureData['sha256-hash'] = "sha256-{$fixtureData['sha256']}";

        $file = new File();
        $file->data = $fixtureData['data'];
        $hashes = ['sha512', 'sha256'];
        $this->assertRegExp('/sha512\-/', $file->hash($hashes));
        $this->assertStringContainsString("{$fixtureData['sha512-hash']}", $file->hash($hashes));
        $this->assertStringContainsString("{$fixtureData['sha256-hash']}", $file->hash($hashes));
    }
}
