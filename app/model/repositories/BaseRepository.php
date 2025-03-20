<?php
namespace app\models\repositories;

use PDO;
use app\Config\Database;

class BaseRepository {
    protected $table;
    protected $entityClass;
    protected $db;

    public function __construct($table, $entityClass) {
        $this->table = $table;
        $this->entityClass = $entityClass;
        $this->db = (new Database())->getConnection();
    }

    protected function executeQuery($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    protected function mapToEntity($data) {
        $entity = new $this->entityClass();
        foreach ($data as $key => $value) {
            if (property_exists($entity, $key)) {
                $entity->$key = $value;
            }
        }
        return $entity;
    }

    public function findAll(): array {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->executeQuery($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
    }

    public function findById(int $id): ?object {
        $sql = "SELECT * FROM $this->table WHERE {$this->table}_id = :id";
        $stmt = $this->executeQuery($sql, [':id' => $id]);
        return $stmt->fetchObject($this->entityClass) ?: null;
    }

    public function delete(int $id): bool {
        $sql = "DELETE FROM $this->table WHERE {$this->table}_id = :id";
        return $this->executeQuery($sql, [':id' => $id])->rowCount() > 0;
    }
}