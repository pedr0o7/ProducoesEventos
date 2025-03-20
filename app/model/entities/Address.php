<?php
namespace app\models\entities;

class Address {
    public int $address_id;
    public string $address;
    public string $zip_code;
    public int $city_id;
}