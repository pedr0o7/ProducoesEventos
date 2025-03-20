<?php
namespace app\Controllers\Auth;

use app\core\Controller;
use app\models\services\RegistrationService;

class RegisterController extends Controller {
    private $registrationService;

    public function __construct() {
        $this->registrationService = new RegistrationService();
    }

    public function showRegistrationForm() {
        $this->render('auth/register');
    }

    public function register() {
        $userData = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];

        if ($this->registrationService->registerUser($userData)) {
            $this->redirect('/user/dashboard');
        } else {
            $this->render('auth/register', ['error' => 'Erro no cadastro']);
        }
    }
}