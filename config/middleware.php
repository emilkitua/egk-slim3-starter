<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", false);

        $prev_link = $view->getEnvironment()->addGlobal('CurrentUrl', $_SERVER["REQUEST_URI"]);

        return $next($request, $response);
    });
    return $guard;

    if (false === $request->getAttribute('csrf_status')) {
        // get the previous route
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if ($refererHeader) {
            // Extract referer value
            $referer = array_shift($refererHeader);
        }
    }
};

$app->add(new \App\Http\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Http\Middleware\OldInputMiddleware($container));
$app->add(new \App\Http\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);
$container->csrf->setPersistentTokenMode(false); //set true if you want to use the same token multiple times on the same page 
