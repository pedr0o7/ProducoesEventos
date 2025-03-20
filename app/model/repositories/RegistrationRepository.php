<?php
namespace app\models\repositories;

use app\models\entities\Users;
use app\models\entities\Registration;
use app\Config\Database;

class RegistrationRepository {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function emailExists(string $email): bool {
        $stmt = $this->db->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->rowCount() > 0;
    }

    public function createUser(Registration $regData): Users {
        $user = new Users();
        $user->name = $regData->name;
        $user->email = $regData->email;
        $user->password_hash = password_hash($regData->password, PASSWORD_DEFAULT);
        $user->role = $regData->role;
        
        if ($regData->role === 'organizer') {
            $user->cnpj = $regData->cnpj;
            $user->company_name = $regData->company_name;
        }

        $stmt = $this->db->prepare("INSERT INTO users (...) VALUES (...)");
        $stmt->execute();
        
        $user->user_id = $this->db->lastInsertId();
        return $user;
    }
}