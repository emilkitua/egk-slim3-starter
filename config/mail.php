<?php

$container['mail'] = function ($container) {
    $config = $container->settings['mail'];

    $transport = (Swift_SmtpTransport::newInstance($config['host'], $config['port']))
        ->setUsername($config['username'])
        ->setPassword($config['password']);

    $swift = Swift_Mailer::newInstance($transport);

    return (new App\Mail\Mailer\Mailer($swift, $container->view))
        ->alwaysFrom($config['from']['address'], $config['from']['name']);
};