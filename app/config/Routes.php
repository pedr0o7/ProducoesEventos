<?php
use app\core\Router;

// ==================================================
// 1. Rotas Públicas
// ==================================================
Router::group([], function() {
    // Página Inicial
    Router::get('/', function() {
        $viewPath = realpath(__DIR__.'/../../view/home.php');
        if ($viewPath && file_exists($viewPath)) {
            require $viewPath;
        } else {
            http_response_code(500);
            die("Erro: Arquivo home.php não encontrado");
        }
    });

    // Login
    Router::get('/login', function() {
        $viewPath = realpath(__DIR__.'/../../view/auth/login.php');
        if ($viewPath && file_exists($viewPath)) {
            require $viewPath;
        } else {
            http_response_code(500);
            die("Erro: Arquivo login.php não encontrado");
        }
    });
});

// ==================================================
// 2. Rotas do Usuário Autenticado
// ==================================================
Router::group([
    'prefix' => '/user',
    'middleware' => 'auth'
], function() {
    Router::get('/dashboard', function() {
        require realpath(__DIR__.'/../../view/user/userDashboard.php');
    });
});

// ==================================================
// 3. Sistema de Erros (Versão Corrigida)
// ==================================================
Router::error(404, function() {
    $errorPath = realpath(__DIR__.'/../../view/errors/404.php');
    if ($errorPath) {
        http_response_code(404);
        require $errorPath;
    } else {
        die("Página não encontrada");
    }
    exit;
});

// ==================================================
// 4. Execução do Roteador
// ==================================================
Router::dispatch();