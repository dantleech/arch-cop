<?php

namespace ArchCop\Service;

use ArchCop\Model\User;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;

final class UserCreationService
{
    public function createUser(string $username, string $email): User
    {
        return new User(
            Uuid::uuid4(),
            $username,
            $email
        );
    }
}
