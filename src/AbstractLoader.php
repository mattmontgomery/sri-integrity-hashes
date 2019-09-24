<?php

namespace DDM\SRIIntegrityHash;

abstract class AbstractLoader implements LoaderInterface
{
    public $files = [];
    
    public function getFiles(): array
    {
        return $this->files;
    }
}
