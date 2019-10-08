<?php

namespace DDM\SRIIntegrityHash;

abstract class AbstractLoader implements LoaderInterface
{
    public $namespace;
    public $files = [];

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }
}
