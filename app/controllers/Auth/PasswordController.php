<?php
namespace app\Controllers\Auth;

use app\core\Controller;
use app\models\services\PasswordService;

class PasswordController extends Controller {
    private $passwordService;

    public function __construct() {
        $this->passwordService = new PasswordService();
    }

    public function showLinkRequestForm() {
        $this->render('auth/resetPassword');
    }

    public function sendResetLinkEmail() {
        $email = $_POST['email'];
        $this->passwordService->sendResetLink($email);
        $this->redirect('/login');
    }
}