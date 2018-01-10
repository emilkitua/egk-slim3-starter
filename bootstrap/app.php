<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

use Respect\Validation\Validator as v;

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

// Instantiate the app
$settings = require __DIR__ . '/../config/app.php';
$app = new \Slim\App($settings);

$container = $app->getContainer();

$container['phpErrorHandler'] = function ($container) {
    return function ($request, $response, $error) use ($container) {
        //error 500
        return $container->view->render($response, 'error/500.twig')->withStatus(500);

        //error 400
        return $container->view->render($response, 'error/400.twig')->withStatus(400);
    };
};

// set up database
require __DIR__ . '/../config/database.php';

// set up views
require __DIR__ . '/../config/views.php';

// set up mail
require __DIR__ . '/../config/mail.php';

// set up logger
require __DIR__ . '/../config/logger.php';

// set up dependancies
require __DIR__ . '/../config/dependencies.php';

// Register middleware
require __DIR__ . '/../config/middleware.php';

v::with('App\\Validation\\Rules\\');

// Register routes
require_once __DIR__ . '/../routes/web.php';


