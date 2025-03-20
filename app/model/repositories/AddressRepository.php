<?php
namespace app\models\repositories;

use app\models\entities\Address;

class AddressRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('address', Address::class);
    }

    public function findByZipCode(string $zipCode): ?Address {
        $sql = "SELECT * FROM address WHERE zip_code = :zip_code";
        $stmt = $this->executeQuery($sql, [':zip_code' => $zipCode]);
        return $stmt->fetchObject($this->entityClass) ?: null;
    }
    public function create(Address $address): bool {
        $sql = "INSERT INTO address (address, zip_code, city_id)
                VALUES (:address, :zip, :city)";
        return $this->executeQuery($sql, [
            ':address' => $address->address,
            ':zip' => $address->zip_code,
            ':city' => $address->city_id
        ])->rowCount() > 0;
    }
}