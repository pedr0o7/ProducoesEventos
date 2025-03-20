<?php
namespace app\models\repositories;

use app\models\entities\Street;

class StreetRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('street', Street::class);
    }
}