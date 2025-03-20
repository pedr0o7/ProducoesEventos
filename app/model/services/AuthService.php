<?php
namespace app\models\services;

use app\core\Session;
use app\models\repositories\AuthRepository;
use app\models\repositories\UsersRepository;
use app\models\entities\Users;

class AuthService {
    private $authRepo;
    private $userRepo;
    private $session;

    public function __construct() {
        $this->authRepo = new AuthRepository();
        $this->userRepo = new UsersRepository();
        $this->session = new Session();
    }

    public function attemptLogin(string $email, string $password): bool {
        $user = $this->authRepo->getByCredentials($email, $password);
        
        if ($user) {
            $this->session->set('user', [
                'id' => $user->user_id,
                'role' => $user->role
            ]);
            return true;
        }
        return false;
    }

    public function registerUser(array $data): bool {
        $user = new Users();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->role = 'customer';
        
        return $this->userRepo->createUser($user);
    }

    public function getCurrentUser(): ?Users {
        $userId = $this->session->get('user.id');
        return $userId ? $this->userRepo->findById($userId) : null;
    }

    public function logout(): void {
        $this->session->destroy();
    }
    public function isLoggedIn(): bool {
        return $this->session->get('user.id') !== null;
    }
}