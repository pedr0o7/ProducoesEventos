<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/Config/constants.php';

session_start();

use app\core\Router;
use app\core\Session;

// Rotas
require __DIR__ . '/../app/Config/Routes.php';

// Tratamento de erros
set_exception_handler(function ($e) {
    error_log($e->getMessage());
    http_response_code(500);
    if (APP_ENV === 'development') {
        echo "<h1>500 Internal Server Error</h1>";
        echo "<pre>" . $e . "</pre>";
    } else {
        require VIEWS_PATH . 'errors/500.php';
    }
    exit;
});

// Dispatch da rota
Router::dispatch();