<?php
namespace app\Controllers\Auth;

use app\core\Controller;
use app\models\services\AuthService;

class LoginController extends Controller {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function showLoginForm() {
        $this->render('auth/login');
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if ($this->authService->attemptLogin($email, $password)) {
            $this->redirect('/user/dashboard');
        } else {
            $this->render('auth/login', ['error' => 'Credenciais inválidas']);
        }
    }

    public function logout() {
        $this->authService->logout();
        $this->redirect('/login');
    }
}