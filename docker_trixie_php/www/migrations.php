<?php
require_once __DIR__ . '/public/../bootstrap/app.php';
require_once BASE_PATH . '/vendors/spl_auto_loader.php';
require_once BASE_PATH. '/bootstrap/envLoader.php';

use App\Core\Application;

$app = new Application;

$app->db->applyMigrations();
