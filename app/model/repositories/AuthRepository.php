<?php
namespace app\models\repositories;

use app\models\entities\Users;
use app\Config\Database;

class AuthRepository {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getByCredentials(string $email, string $password): ?Users {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        $user = $stmt->fetchObject(Users::class);
        
        if ($user && password_verify($password, $user->password_hash)) {
            return $user;
        }
        
        return null;
    }

    public function createUserToken(int $userId, string $token): bool {
        $sql = "INSERT INTO user_tokens (user_id, token) VALUES (:user_id, :token)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':token' => $token
        ]);
    }
}