<?php
namespace app\models\services;

use app\models\repositories\PasswordRepository;
use app\models\repositories\UserRepository;
use app\models\entities\Users;
use app\core\Session;

class PasswordService {
    private $passwordRepo;
    private $userRepo;
    private $session;

    public function __construct() {
        $this->passwordRepo = new PasswordRepository();
        $this->userRepo = new UserRepository();
        $this->session = new Session();
    }

    public function sendResetLink(string $email): bool {
        $user = $this->userRepo->findByEmail($email);
        
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            $this->passwordRepo->createToken(
                $user->user_id, 
                $token, 
                $expiresAt
            );
            
            // Simulação de envio de email
            $resetLink = "https://seusite.com/reset-password?token=$token";
            $this->session->setFlash('reset_link', $resetLink);
            
            return true;
        }
        
        return false;
    }

    public function resetPassword(string $token, string $newPassword): bool {
        $resetRequest = $this->passwordRepo->findValidToken($token);
        
        if ($resetRequest && !$resetRequest->used) {
            $user = $this->userRepo->findById($resetRequest->user_id);
            
            $user->password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $this->userRepo->update($user);
            
            $this->passwordRepo->invalidateToken($resetRequest->reset_id);
            return true;
        }
        
        return false;
    }
}