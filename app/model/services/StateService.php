<?php
namespace app\models\services;

use app\models\repositories\StateRepository;

class StateService {
    private $repo;

    public function __construct() {
        $this->repo = new StateRepository();
    }

    public function getStatesByCountry(int $countryId): array {
        return $this->repo->findStatesByCountry($countryId);
    }
}