<?php

namespace ArchCOP\Client;

class MemoisedRepositoryClient implements RepositoryClient
{
    private RepositoryClient $innerClient;

    public function __construct(RepositoryClient $innerClient)
    {
        $this->innerClient = $innerClient;
    }

    /**
     * {@inheritDoc}
     */
    public function repositories(string $org): array
    {
        if (isset($this->cache[$org])) {
            return $this->cache[$org];
        }

        $this->cache[$org] = $this->innerClient->repositories($org);

        return $this->cache[$org];
    }
}
