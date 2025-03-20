<?php
namespace app\models\repositories;

use app\models\entities\Profile;
use PDO;

class ProfileRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('users', Profile::class);
    }

    public function updateProfile(int $userId, array $data): bool {
        $allowedFields = ['name', 'bio', 'website', 'social_facebook', 'social_instagram', 'phone'];
        $updates = [];
        $params = [':id' => $userId];

        foreach ($data as $key => $value) {
            if (in_array($key, $allowedFields)) {
                $updates[] = "$key = :$key";
                $params[":$key"] = $value;
            }
        }

        if (empty($updates)) return false;

        $sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE user_id = :id";
        return $this->executeQuery($sql, $params)->rowCount() > 0;
    }

    public function updateProfileImage(int $userId, string $imagePath): bool {
        $sql = "UPDATE users SET profile_image = :image WHERE user_id = :id";
        return $this->executeQuery($sql, [
            ':image' => $imagePath,
            ':id' => $userId
        ])->rowCount() > 0;
    }
}