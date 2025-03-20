<?php
namespace app\models\repositories;

use app\models\entities\State;

class StateRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('state', State::class);
    }

    public function findStatesByCountry(int $countryId): array {
        $sql = "SELECT * FROM state WHERE country_id = :country_id";
        $stmt = $this->executeQuery($sql, [':country_id' => $countryId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
    }
}