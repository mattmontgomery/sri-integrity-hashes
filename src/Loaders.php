<?php

namespace DDM\SRIIntegrityHash;

class Loaders
{
    private $loaders = [];
    private $files = [];

    /**
     * Register a loader
     *
     * @param LoaderInterface $loader
     * @return void
     */
    public function register(LoaderInterface $loader): void
    {
        $this->loaders[$loader->getNamespace()] = $loader;
        $this->files = array_merge($this->files, $loader->files);
    }

    /**
     * Get a file given a namespace and filename
     *
     * @param string $namespace
     * @param string $filename
     * @return File|null
     */
    public function getFile(string $namespace, string $filename): ?File
    {
        if (empty($this->loaders[$namespace])) {
            $this->register(new FileLoader($namespace));
        }
        foreach ($this->files as $namespacedFilename => $file) {
            if ($namespacedFilename === FileLoader::format($namespace, $filename)) {
                return $file;
            }
        }
        return null;
    }

    /**
     * Return all files
     *
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Return all registered loaders
     */
    public function getLoaders(): array
    {
        return $this->loaders;
    }
}
