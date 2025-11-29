<?php
require_once __DIR__ . '/../bootstrap/app.php';
require_once BASE_PATH . '/vendors/spl_auto_loader.php';
require_once BASE_PATH . '/config/routes.php';

use App\Core\Application;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;

$app = new Application;

$app->router->get('', [SiteController::class, 'home']);

$app->router->get('contact', [SiteController::class, 'contact']);
$app->router->post('contact',[SiteController::class, 'handleContact'] );

$app->router->get('login',[AuthController::class, 'login'] );
$app->router->post('login',[AuthController::class, 'login'] );

$app->router->get('register',[AuthController::class, 'register'] );
$app->router->post('register',[AuthController::class, 'register'] );

$app->run();
