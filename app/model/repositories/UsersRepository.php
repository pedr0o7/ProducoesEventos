<?php
require_once "Database.php";
require_once '../model/DTO/UsersDTO.php';

class UsersDAO
{
    private $conn;
    public $pdo = null;
    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }
    public function cadastrarUsers(UsersDTO $usersDTO
    ) {
        try {
            $sql = "INSERT INTO users (name,email, password_hash, role, address_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $users = $usersDTO->getUsers();
            $stmt->bindValue(1, $users["name"]);
            $stmt->bindValue(2, $users["email"]);
            $stmt->bindValue(3, $users["password_hash"]);
            $stmt->bindValue(4, $users["role"]);
            $stmt->bindValue(5, $users["address_id"]);
            $returno = $stmt->execute();
            return $returno;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function findByUsers($usersDTO)
    {
        try {
            $sql = "SELECT * FROM users WHERE email  = ? and address_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $users = $usersDTO->getusers();
            $stmt->bindValue(1, $users["email"]);
            $stmt->bindValue(2, $users["address_id"]);
            $stmt->execute();
            $returno = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $returno;
            // $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function findByEmail($usersDTO)
    {
        try {
            $sql = "SELECT * FROM users WHERE email  = ?";
            $stmt = $this->pdo->prepare($sql);
            $users = $usersDTO->getusers();
            $stmt->bindValue(1, $users["email"]);
            $stmt->execute();
            $returno = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $returno;
            // $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    // Adicione estes métodos na sua classe UsersDAO
    public function emailExists($usersDTO)
    {   
        $sql = "SELECT `user_id` FROM users WHERE email  = ?";
        $stmt = $this->pdo->prepare($sql);
        $users = $usersDTO->getusers();
        $stmt->bindValue(1, $users["email"]); 
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function storePasswordResetToken($usersDTO)
    {
        
        $sql = "INSERT INTO password_reset_tokens (email, token, expires_at)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE token = ?, expires_at = ?";
        $stmt = $this->pdo->prepare($sql);
        $users = $usersDTO->getusers();
        $stmt->bindValue(1, $users["email"]);
        $stmt->bindValue(2, $users["token"]);
        $stmt->bindValue(3, $users["expires_at"]);
        $stmt->bindValue(4, $users["token"]);
        $stmt->bindValue(5, $users["expires_at"]);

        return $stmt->execute();
    }

    public function getPasswordResetToken($usersDTO)
    {
        $sql = "SELECT token, expires_at FROM password_reset_tokens WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $users = $usersDTO->getusers();
        $stmt->bindValue(1, $users["email"]);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletePasswordResetToken($usersDTO)
    {
        $sql = "DELETE FROM password_reset_tokens WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $users = $usersDTO->getusers();
        $stmt->bindValue(1, $users["email"]);
        return $stmt->execute();
    }

    public function updatePassword($usersDTO){
        $sql = "Update users set password_hash = ? where email = ?";
        $stmt = $this->pdo->prepare($sql);
        $users = $usersDTO->getusers();
        $stmt->bindValue(1, $users["password_hash"]);
        $stmt->bindValue(2, $users["email"]);
        $stmt->execute();
        return $stmt->execute();
    }

    public function getTotalUsers() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM users");
        return $stmt->fetchColumn();

    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'UsersDTO');
    }
}
