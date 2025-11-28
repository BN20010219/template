<?php
require_once __DIR__ . '/../bootstrap/app.php';
require_once BASE_PATH . '/vendors/spl_auto_loader.php';
require_once BASE_PATH . '/config/routes.php';

use App\Core\Router;
use App\Core\Request;

$request = new Request();    // Encapsulates incoming request data

// Dispatcher/Router takes the current request and all routes
$router = new Router($routes);

$router->dispatch($request);
