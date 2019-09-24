<?php

namespace DDM\SRIIntegrityHash;

interface ReaderInterface
{
    public function read($resource): File;
}