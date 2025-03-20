<?php
namespace app\models\services;

use app\models\repositories\UsersRepository;
use app\models\entities\Users;

class UsersService {
    private $repo;

    public function __construct() {
        $this->repo = new UsersRepository();
    }

    public function getUserByEmail(string $email): ?Users {
        return $this->repo->findByEmail($email);
    }

    public function createUser(Users $user): bool {
        return $this->repo->createUsers($user);
    }

    public function getOrganizers(): array {
        return $this->repo->findOrganizers();
    }
}