<?php
namespace app\models\repositories;

use app\models\entities\City;

class CityRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('city', City::class);
    }

    public function findCitiesByState(int $stateId): array {
        $sql = "SELECT * FROM city WHERE state_id = :state_id";
        $stmt = $this->executeQuery($sql, [':state_id' => $stateId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
    }
}