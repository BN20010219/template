<?php 
// Autoload (simple PSR-4-inspired)
spl_autoload_register(function($class) {
    $prefixes = [
        //Maps namespace prefix to its directory path
        'App\\' => APP_PATH,
    ];
    
    foreach ($prefixes as $prefix => $base_dir) {
        if (strpos($class, $prefix) === 0) { // checks if class namespace starts with the prefix
            $relative_class = substr($class, strlen($prefix));
            $file = $base_dir . '/' . str_replace('\\', '/', $relative_class) . '.php';
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }

});
