<?php

namespace ArchCOP\Container;

use Closure;
use Psr\Container\ContainerInterface;
use RuntimeException;

class Container implements ContainerInterface
{
    private $factories = [];
    private $services = [];

    public function register(string $id, Closure $factotry)
    {
        $this->factories[$id] = $factotry;
    }

    public function get(string $id): object
    {
        if (isset($this->services[$id])) {
            return $this->services[$id];
        }

        if (!isset($this->factories[$id])) {
            throw new RuntimeException(
                'No service  ' . $id . ' ' . implode('", "', array_keys($this->factories))
            );
        }

        $factory = $this->factories[$id];
        $service = $factory($this);
        $this->services[$id] = $service;

        return $service;
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $id): bool
    {
        return isset($this->factories[$id]);
    }
}
