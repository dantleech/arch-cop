<?php

namespace ArchCOP;

use ArchCOP\Client\FileGetContentsRepositoryClient;
use ArchCOP\Client\RepositoryClient;

class App
{
    private RepositoryClient $client;

    public function __construct(RepositoryClient $client)
    {
        $this->client = $client;
    }

    public function run(string $org): void
    {
        foreach ($this->client->repositories($org) as $repo) {
            echo $repo->url() . "\n";
        }
    }
}
