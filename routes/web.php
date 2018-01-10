<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;

// Routes
$app->get('/{name}', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $name = $args['name'];
    // Render index view
    return $this->view->render($response, 'index.html', compact('name'));
});
