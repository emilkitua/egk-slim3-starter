<?php

//for flash messages
$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages;
};

//for views
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => $container->settings['views']['cache']
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    $view->getEnvironment()->addGlobal('auth', [
         'check' => $container->auth->check(),
         'user' => $container->auth->user(),
    ]);

    return $view;
};

//not found handler
$container['notFoundHandler'] = function ($container){
    return function($request, $response) use ($container){
        $container->view->render($response, 'error/404.twig');
        // return $container->view->render($response, 'errors/404.twig');
        return $response->withStatus(404);
    };
};
