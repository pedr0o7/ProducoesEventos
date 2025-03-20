<?php
namespace app\models\services;

use app\models\repositories\StreetRepository;

class StreetService {
    private $repo;

    public function __construct() {
        $this->repo = new StreetRepository();
    }
}