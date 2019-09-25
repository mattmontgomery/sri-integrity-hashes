<?php

namespace DDM\SRIIntegrityHash;

abstract class AbstractReader implements ReaderInterface
{
    protected function create(string $filename)
    {
        $file = new File();
        $file->filename = $filename;
        return $file;
    }
}
