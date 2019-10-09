<?php

namespace DDM\SRIIntegrityHash;

class File
{
    /**
     * @var string
     */
    public $filename;
    /**
     * @var string
     */
    public $source;
    /**
     * @var string
     */
    public $integrity;
    /**
     * @var string
     */
    public $data;

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
    /**
     * @param string[] $algorithms
     * @return string
     */
    public function hash(array $algorithms = ["sha512"]): string
    {
        return implode(" ", array_map(function ($algo) {
            return sprintf("%s-%s", $algo, base64_encode(hash($algo, $this->data)));
        }, $algorithms));
    }
}
