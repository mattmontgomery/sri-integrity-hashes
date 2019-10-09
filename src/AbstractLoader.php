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
    /**
     * @codeCoverageIgnoreStart
     * This function is not currently testable as no Loader types implement a generic namespace function as above
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }
    /**
     * @codeCoverageIgnoreEnd
     */
}
