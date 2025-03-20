<?php
namespace app\models\services;

use app\models\entities\Registration;
use app\models\repositories\RegistrationRepository;
use app\core\Session;
use app\models\repositories\UsersRepository;
use app\models\entities\Users;

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
    public function registerUser(Users $user): bool {
        return $this->userRepo->createUsers($user);
    }

    
}