<?php

namespace ArchCOP\Client;

interface RepositoryClient
{
    /**
     * @return Repository
     */
    public function repositories(string $org): array;
}
