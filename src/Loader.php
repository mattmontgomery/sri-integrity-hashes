<?php

namespace DDM\SRIIntegrityHash;

class Loader extends AbstractLoader
{
    public $filename;
    public $files;
    /**
     * @param string $filename
     * @param string $namespace
     * @throws LoaderException
     * @return void
     */
    public function __construct(string $filename)
    {
        if (!is_file($filename)) {
            throw new LoaderException("{$filename} does not exist or could not be read");
        }
        $this->filename = $filename;
        $fileContents = file_get_contents($filename);
        $decodedData = json_decode($fileContents, true);

        if (empty($decodedData)) {
            throw new LoaderException("{$filename} does not include json data");
        }

        $this->files = $this->process($decodedData, $filename);
    }

    /**
     * @param array $data
     * @param string $namespace
     * @return array
     */
    public function process(array $data, string $namespace): array
    {
        $files = [];
        foreach ($data as $filename => $asset) {
            $file = new File();
            $file->filename = $filename;
            $file->source = $asset['src'];
            $file->integrity = $asset['integrity'];
            $file->namespace = $namespace;
            $files["{$namespace}:{$filename}"] = $file;
        }
        return $files;
    }

    /**
     * @param string $filename
     * @return File|null
     */
    public function getFile(string $filename): ?File
    {
        return $this->files[self::format($this->filename, $filename)] ?? null;
    }
    /**
     * Format names consistently across the application
     *
     * @param string $namespace
     * @param string $filename
     * @return string
     */
    public static function format(string $namespace, string $filename): string
    {
        return sprintf("%s:%s", $namespace, $filename);
    }
}
