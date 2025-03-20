<?php
namespace app\core;

use app\models\services\AuthService;
use app\models\entities\Users;

class Auth {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function user(): ?Users {
        return $this->authService->getCurrentUser();
    }

    public function check(): bool {
        return $this->authService->isLoggedIn();
    }

    public function attempt(array $credentials): bool {
        return $this->authService->attemptLogin(
            $credentials['email'], 
            $credentials['password']
        );
    }

    public function logout(): void {
        $this->authService->logout();
    }

    public function register(array $data): bool {
        return $this->authService->registerUser($data);
    }
}