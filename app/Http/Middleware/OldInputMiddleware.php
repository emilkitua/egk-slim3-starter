<?php

namespace App\Http\Middleware;

class OldInputMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
 		// if (isset($_SESSION['old'])) {
	        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']));
	        $_SESSION['old'] = $request->getParams();
	    // }

        $response = $next($request, $response);
        return $response;
    }
}
