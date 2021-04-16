<?php

namespace ArchCOP\Client;

use ArchCOP\Model\Repository;
use RuntimeException;

class RepositoryClient
{
    /**
     * @return Repository
     */
    public function repositories(string $org): array
    {
        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP'
                ]
            ]
        ];

        $context = stream_context_create($opts);
        $data = file_get_contents(sprintf('https://api.github.com/users/%s', $org), false, $context);

        if (false === $data) {
            throw new RuntimeException(sprintf(
                'Could not get data from Github'
            ));
        }

        $data = json_decode($data, true);

        return array_map(function (array $repo) {
            return new Repository($repo['name'], $repo['html_url']);
        }, $data);
    }
}
