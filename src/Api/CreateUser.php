<?php

namespace ArchCop\Api;

final class CreateUser
{
    public string $username;

    public string $email;

    public function __construct(
        string $username,
        string $email,
        Foobar $foobar
    )
    {
        $this->username = $username;
        $this->email = $email;
    }
}
