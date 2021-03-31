<?php

use ArchCop\Api\CreateUser;
use ArchCop\Model\User;
use ArchCop\Service\UserCreationService;
use DTL\Invoke\Invoke;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/', function (Request $request, Response $response, array $args) {

    $map = json_decode($request->getBody()->getContents(), true);

    $createUser = Invoke::new(User::class, $map);
    assert($createUser instanceof CreateUser);

    $service = $this->get(UserCreationService::class);
    assert($service instanceof UserCreationService);

    $user = $service->createUser(
        $createUser->username,
        $createUser->email
    );

    $response->getBody()->write($user->id());
    return $response;
});

