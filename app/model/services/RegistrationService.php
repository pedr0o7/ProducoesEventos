<?php
namespace app\models\services;

use app\models\entities\Registration;
use app\models\repositories\RegistrationRepository;
use app\core\Session;
use app\models\repositories\UsersRepository;

class RegistrationService {
    private $repo;
    private $session;
    private $userRepo;

    public function __construct() {
        $this->repo = new RegistrationRepository();
        $this->session = new Session();
        $this->userRepo = new UsersRepository();
    }

    public function register(Registration $regData): array {
        $errors = $regData->validate();
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        if ($this->repo->emailExists($regData->email)) {
            return ['success' => false, 'errors' => ['email' => 'Email já cadastrado']];
        }

        try {
            $user = $this->repo->createUser($regData);
            $this->session->set('temp_user', $user);
            return ['success' => true];
            
        } catch (\PDOException $e) {
            return ['success' => false, 'errors' => ['system' => 'Erro no cadastro']];
        }
    }

    public function completeOrganizerRegistration(array $orgData): bool {
        // Lógica adicional para cadastro de organizadores
        return true;
    }

    public function registerUser(array $userData): bool {
        $user = new Users();
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password_hash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->role = 'customer';
        $user->address_id = 0; // Valor padrão ou lógica para address_id
        
        return $this->userRepo->createUsers($user);
    }
    
}