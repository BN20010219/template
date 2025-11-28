<?php

namespace App\Core;

use App\Http\Controllers\Controllers;

class Router
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function  dispatch(Request $request)
    {
    }
}
