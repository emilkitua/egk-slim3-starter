<?php

$container['auth'] = function ($container) {
    return new \App\Auth\Auth;
};

$container['validator'] = function ($container) {
    return new App\Validation\Validator;
};
