<?php

use ArchCop\Service\UserCreationService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/', function (Request $request, Response $response, array $args) {

    $json = json_decode($request->getBody()->getContents(), true);

    $service = $this->get(UserCreationService::class);
    assert($service instanceof UserCreationService);

    $user = $service->createUser($json['username'], $json['email']);


    $response->getBody()->write($user->id());
    return $response;
});

