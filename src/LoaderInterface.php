<?php

namespace DDM\SRIIntegrityHash;

interface LoaderInterface
{
    public function __construct(string $filename);
    public function process(array $data, string $namespace): array;
    public function getFiles(): array;
    public function getNamespace(): string;
}
