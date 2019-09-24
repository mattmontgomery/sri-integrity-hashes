<?php

namespace DDM\SRIIntegrityHash;

class File
{
    public $filename;
    public $source;
    public $integrity;
    
    /**
     * Outputs a script tag with the integrity tag
     *
     * @param boolean $async
     * @return string
     */
    public function toScript(bool $async = false): string
    {
        return sprintf('<script src="%s" %s integrity="%s"></script>', $this->source, $async ? "async" : "", $this->integrity);
    }
}
