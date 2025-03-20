<?php
spl_autoload_register(function ($className) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    $fullPath = __DIR__ . '/../' . $file;
    
    if (file_exists($fullPath)) {
        require $fullPath;
    }
});