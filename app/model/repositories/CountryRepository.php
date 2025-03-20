<?php
namespace app\models\repositories;

use app\models\entities\Country;

class CountryRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('country', Country::class);
    }

    public function findAllCountries(): array {
        return $this->findAll();
    }
}