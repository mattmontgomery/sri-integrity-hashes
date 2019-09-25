<?php

namespace DDM\SRIIntegrityHash;

class FileReader extends AbstractReader
{
    /**
     * Reads with file_get_contents
     *
     * @param string $filename
     * @return File
     */
    public function read($filename): File
    {
        $file = $this->create($filename);
        try {
            $data = file_get_contents($filename);
        } catch (\Exception $e) {
            throw new ReaderException(sprintf("Could not read from %s", $filename));
        }
        $file->data = $data;
        return $file;
    }
}
