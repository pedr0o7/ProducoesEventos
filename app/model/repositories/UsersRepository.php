<?php
namespace app\models\repositories;

use app\models\entities\Users;

class UsersRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('users', Users::class);
    }

    public function findById(int $id): ?Users {
        $sql = "SELECT * FROM users WHERE user_id = :id";
        $stmt = $this->executeQuery($sql, [':id' => $id]);
        return $stmt->fetchObject($this->entityClass) ?: null;
    }
    public function findOrganizers(): array {
        $sql = "SELECT * FROM users WHERE role = 'organizer'";
        $stmt = $this->executeQuery($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
    }
    public function findByEmail(string $email): ?Users {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->executeQuery($sql, [':email' => $email]);
        return $stmt->fetchObject($this->entityClass) ?: null;
    }

    public function createUsers(Users $user): bool {
        $sql = "INSERT INTO users (name, email, password_hash, role, address_id) 
                VALUES (:name, :email, :password, :role, :address)";
        return $this->executeQuery($sql, [
            ':name' => $user->name,
            ':email' => $user->email,
            ':password' => $user->password_hash,
            ':role' => $user->role,
            ':address' => $user->address_id
        ])->rowCount() > 0;
    }

    public function count(): int {
        $sql = "SELECT COUNT(*) FROM users";
        $stmt = $this->executeQuery($sql);
        return $stmt->fetchColumn();
    }

    public function update(Users $user): bool {
        $sql = "UPDATE users SET 
                name = :name,
                email = :email,
                password_hash = :password,
                role = :role,
                address_id = :address
                WHERE user_id = :id";
        
        return $this->executeQuery($sql, [
            ':name' => $user->name,
            ':email' => $user->email,
            ':password' => $user->password_hash,
            ':role' => $user->role,
            ':address' => $user->address_id,
            ':id' => $user->user_id
        ])->rowCount() > 0;
    }
}