<?php
use app\core\Router;
use app\Controllers\Auth\{
    LoginController,
    RegisterController,
    PasswordController
};
use app\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    OrganizerController
};
use app\Controllers\User\{
    DashboardController as UserDashboardController,
    ProfileController
};
use app\Controllers\Events\EventController;

// Rotas Públicas
Router::get('/', [EventController::class, 'index']);
Router::get('/events/(\d+)', [EventController::class, 'show']);

// Rotas de Autenticação
Router::get('/login', [LoginController::class, 'showLoginForm']);
Router::post('/login', [LoginController::class, 'login']);
Router::get('/register', [RegisterController::class, 'showRegistrationForm']);
Router::post('/register', [RegisterController::class, 'register']);
Router::get('/logout', [LoginController::class, 'logout']);
Router::get('/forgot-password', [PasswordController::class, 'showLinkRequestForm']);
Router::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail']);

// Rotas Protegidas (Usuário)
Router::group(['middleware' => 'auth'], function() {
    Router::get('/user/dashboard', [UserDashboardController::class, 'index']);
    Router::get('/user/profile', [ProfileController::class, 'edit']);
    Router::put('/user/profile', [ProfileController::class, 'update']);
});

// Rotas Administrativas
Router::group(['prefix' => '/admin', 'middleware' => 'admin'], function() {
    Router::get('/dashboard', [AdminDashboardController::class, 'index']);
    Router::get('/organizers', [OrganizerController::class, 'index']);
    Router::get('/organizers/(\d+)/approve', [OrganizerController::class, 'approve']);
});

// Rotas de Erro
Router::error(404, function() {
    return (new ErrorController())->notFound();
});

Router::error(500, function() {
    return (new ErrorController())->serverError();
});