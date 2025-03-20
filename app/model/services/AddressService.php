<?php
namespace app\models\services;

use app\models\repositories\AddressRepository;
use app\models\entities\Address;

class AddressService {
    private $repo;

    public function __construct() {
        $this->repo = new AddressRepository();
    }

    public function getAddressByZipCode(string $zipCode): ?Address {
        return $this->repo->findByZipCode($zipCode);
    }

    public function createAddress(Address $address): bool {
        return $this->repo->create($address);
    }
}