<?php
namespace app\models\entities;

class Users {
    public int $user_id;
    public string $name;
    public string $email;
    public string $password_hash;
    public string $role;
    public \DateTime $created_at;
    public \DateTime $updated_at;
    public int $address_id;
}