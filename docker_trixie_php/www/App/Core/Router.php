<?php

namespace App\Core;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [/* 'get' => ['/' => 'callback_func'],'post' => ['something_data' => 'comething_callback_func']*/];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function add_routes() 
    {
        //add routes from routes array stored in config/routes
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    //resolves to the appropriate controller
    public function resolve()
    {
        $path = $this->request->getpath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        }
        if (is_array($callback)){
            Application::$app->controller = new $callback[0]();
            $callback[0]= Application::$app->controller ;
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        return call_user_func($callback, $this->request);
    }

    // views
    public function renderView($view, $params=[])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', "$viewContent", "$layoutContent" );
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', "$viewContent", "$layoutContent" );
    }

    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once VIEWS_PATH . "/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value){
            $$key = $value;
        } 
        ob_start();
        include_once VIEWS_PATH . "/views/$view.php";
        return ob_get_clean();
    }
}
