<?php

use ArchCop\Service\UserCreationService;
use Phpactor\Container\Container;
use Phpactor\Container\PhpactorContainer;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

ini_set('html_errors', false);
$container = new PhpactorContainer();
$container->register(UserCreationService::class, fn () => new UserCreationService());
AppFactory::setContainer($container);
$app = AppFactory::create();

require __DIR__ . '/routes.php';

$app->run();
