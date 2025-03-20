<?php
namespace app\models\services;

use app\models\repositories\CountryRepository;

class CountryService {
    private $repo;

    public function __construct() {
        $this->repo = new CountryRepository();
    }

    public function getAllCountries(): array {
        return $this->repo->findAllCountries();
    }
}