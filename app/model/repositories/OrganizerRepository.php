<?php
namespace app\models\repositories;

use app\models\entities\Organizer;
use PDO;

class OrganizerRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('users', Organizer::class);
    }

    public function findPendingApprovals(): array {
        $sql = "SELECT * FROM users 
               WHERE role = 'organizer' 
               AND approved = 0"; // Supondo campo 'approved' na tabela
        $stmt = $this->executeQuery($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
    }

    public function approveOrganizer(int $id): bool {
        $sql = "UPDATE users SET approved = 1 WHERE user_id = :id";
        return $this->executeQuery($sql, [':id' => $id])->rowCount() > 0;
    }

    public function createWithCNPJ(Organizer $organizer): bool {
        $sql = "INSERT INTO users (...) VALUES (...)"; // Campos específicos
        return $this->executeQuery($sql, [
            // Parâmetros específicos
        ])->rowCount() > 0;
    }
}