<?php

namespace DDM\SRIIntegrityHash;

class FileReader extends AbstractReader
{
    /**
     * Reads with file_get_contents
     *
     * @param string $filename
     * @param array $options
     * @return File
     */
    public function read($filename, ReaderOptionsInterface $options = null): File
    {
        $file = $this->create($filename);
        try {
            $data = $this->fileGetContents($filename, $options ? $options->toArray() : []);
        } catch (\Exception $e) {
            throw new ReaderException(sprintf("Could not read from %s", $filename));
        }
        $file->data = $data;
        return $file;
    }
    public function fileGetContents(string $filename, array $options): string
    {
        return file_get_contents($filename, false, stream_context_create($options));
    }
}
