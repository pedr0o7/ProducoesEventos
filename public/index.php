<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require __DIR__ . '/../app/autoload.php'; // Substitui todos os requires
require __DIR__ . '/../app/Config/constants.php';
// Caminhos absolutos corrigidos
require __DIR__ . '/../app/core/View.php';
require __DIR__ . '/../app/core/Router.php';
require __DIR__ . '/../app/core/Session.php';
// require __DIR__ . '/../app/Config/constants.php';

session_start();

use app\core\Router;


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