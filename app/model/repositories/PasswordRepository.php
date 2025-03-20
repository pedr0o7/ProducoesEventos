<?php
namespace app\models\repositories;

use app\models\entities\PasswordReset;
use PDO;

class PasswordRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('password_resets', PasswordReset::class);
    }

    public function createToken(int $userId, string $token, string $expiresAt): bool {
        $sql = "INSERT INTO password_resets 
               (user_id, token, expires_at) 
               VALUES 
               (:user_id, :token, :expires_at)";
        
        return $this->executeQuery($sql, [
            ':user_id' => $userId,
            ':token' => $token,
            ':expires_at' => $expiresAt
        ])->rowCount() > 0;
    }

    public function findValidToken(string $token): ?PasswordReset {
        $sql = "SELECT * FROM password_resets 
               WHERE token = :token 
               AND used = 0 
               AND expires_at > NOW()";
        
        $stmt = $this->executeQuery($sql, [':token' => $token]);
        return $stmt->fetchObject($this->entityClass) ?: null;
    }

    public function invalidateToken(int $resetId): bool {
        $sql = "UPDATE password_resets SET used = 1 WHERE reset_id = :id";
        return $this->executeQuery($sql, [':id' => $resetId])->rowCount() > 0;
    }
}