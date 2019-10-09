<?php

namespace DDM\SRIIntegrityHash;

class FileReaderOptions implements ReaderOptionsInterface
{
    private $ssl = [
        "verify_peer" => true,
        "verify_peer_name" => true,
    ];
    public function setSslVerify(bool $ssl): self
    {
        $this->ssl['verify_peer'] = $ssl;
        $this->ssl['verify_peer_name'] = $ssl;
        return $this;
    }
    public function toArray(): array
    {
        return [
            'ssl' => $this->ssl
        ];
    }
}
