<?php

namespace ArchCOP\Client;

use function file_get_contents;
use function str_replace;
use function unserialize;

class CachingRepositoryClient implements RepositoryClient
{
    private RepositoryClient $innerClient;

    public function __construct(RepositoryClient $client)
    {
        $this->innerClient = $client;
    }

    /**
     * {@inheritDoc}
     */
    public function repositories(string $org): array
    {
        $filenam = str_replace('/', '_', $org).'.cache';

        if (file_exists($filenam)) {
            return unserialize(file_get_contents($filenam));
        }

        file_put_contents($filenam, serialize($this->innerClient->repositories($org)));

        return $this->repositories($org);
    }
}
