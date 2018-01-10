<?php

namespace App\Http\Middleware;

class CsrfViewMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('csrf', [
            'field' => '
                <input id="csrf_name" type="hidden" name="' . $this->container->csrf->getTokenNameKey() . '" value="' . $this->container->csrf->getTokenName() . '">
                <input id="csrf_value" type="hidden" name="' . $this->container->csrf->getTokenValueKey() . '" value="' . $this->container->csrf->getTokenValue() . '">
            ',
            'keys' => [
                    'name'  => $this->container->csrf->getTokenNameKey(),
                    'value' => $this->container->csrf->getTokenValueKey()
                ],
            'name'  => $this->container->csrf->getTokenName(),
            'value' => $this->container->csrf->getTokenValue()
        ]);
        
        $response = $next($request, $response);
        return $response;
    }

    // public function __invoke($request, $response, $next){

    //     $nameKey = $this->container->csrf->getTokenNameKey();
    //     $valueKey = $this->container->csrf->getTokenValueKey();

    //     $name = $this->container->csrf->getTokenName();
    //     $value = $this->container->csrf->getTokenValue();

    //     // Render HTML form which POSTs to /bar with two hidden input fields for the
    //     // name and value:
    //     $output  = '<input type="hidden" name="'.$nameKey .'" value="'.$name .'">';
    //     $output .= '<input type="hidden" name="'.$valueKey.'" value="'.$value.'">';

    //     // Append The CSRF Guards To The View
    //     $this->container->view->getEnvironment()->addAttribute('csrf_gards', $output);

    //     // Pass the Request to the next one
    //     $response = $next($request, $response);
    //     return $response;
    // }
}
