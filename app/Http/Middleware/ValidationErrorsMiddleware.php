<?php

namespace App\Http\Middleware;

class ValidationErrorsMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        // if (isset($_SESSION['errors'])) {
            $this->container->view->getEnvironment()->addGlobal('errors', isset($_SESSION['errors']));
            unset($_SESSION['errors']);
 		// }﻿

        $response = $next($request, $response);
        return $response;
    }
}
