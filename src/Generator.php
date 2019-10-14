<?php

namespace DDM\SRIIntegrityHash;

class Generator
{
    /**
     * @var DDM\SRIIntegrityHash\File[]
     */
    private $files = [];
    /**
     * @var string[]
     */
    private $algos = ['sha512', 'sha256'];

    public function __construct(?array $algos = null)
    {
        if (!empty($algos)) {
            $this->algos = $algos;
        }
    }
    /**
     * @param ReaderInterface $reader
     * @param mixed $resource
     * @return File
     */
    public function read(ReaderInterface $reader, $resource, ReaderOptionsInterface $options = null): File
    {
        $file = $reader->read($resource, $options);
        $this->files[] = $file;
        return $file;
    }
    /**
     * Output the script as JSON
     *
     * @return string
     */
    public function toJSON(): string
    {
        $data = [];
        foreach ($this->files as $file) {
            $data[$file->filename] = [
                'src' => $file->filename,
                'integrity' => $file->hash($this->algos)
            ];
        }
        return json_encode($data);
    }
}
