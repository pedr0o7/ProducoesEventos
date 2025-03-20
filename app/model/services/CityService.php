<?php
namespace app\models\services;

use app\models\repositories\CityRepository;

class CityService {
    private $repo;

    public function __construct() {
        $this->repo = new CityRepository();
    }

    public function getCitiesByState(int $stateId): array {
        return $this->repo->findCitiesByState($stateId);
    }
}