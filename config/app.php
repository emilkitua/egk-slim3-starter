<?php
return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_DEBUG') === 'true', // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        "determineRouteBeforeAppMiddleware" => true,
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../resources/views/',
        ],
        //set views and cache folder
        'views' => [
            'cache' => false, // __DIR__ . '/../storage/views'
        ],
        //set for mail
        'mail' => [
            'host' => getenv('MAIL_HOST'),
            'port' => getenv('MAIL_PORT'),
            'from' => [
                'name' => getenv('MAIL_FROM_NAME'),
                'address' => getenv('MAIL_FROM_ADDRESS')
            ],
            'username' => getenv('MAIL_USERNAME'),
            'password' => getenv('MAIL_PASSWORD'),
        ],
        //set fro database illuminate
        'db' => [
            'driver' => 'mysql',
            'host' => getenv('DB_HOST'),
            'port' => getenv('DB_PORT'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => getenv('DB_CHARSET'),
            'collation' => getenv('DB_COLLATION'),
            'prefix' => '',
        ],
        // Monolog settings
        'logger' => [
            'name' => getenv('APP_NAME'),
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'csrf' => [
            'csrf_regenerate' => false,
        ],
    ],
];
