<?php

namespace App\Core;

use App\Http\Controllers\Controller;

class Application 
{
    public Request $request;
    public Router $router;
    public Response $response;
    public static Application $app;
    public Controller $controller;

    public function __construct()
    {
        self::$app = $this;
        $this->request= new Request;
        $this->response= new Response;
        $this->router= new Router($this->request, $this->response);    
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController($controller): void
    {
        $this->controller =$controller;
    }
}
