<?php
namespace app\models\entities;

class PasswordReset {
    public int $reset_id;
    public int $user_id;
    public string $token;
    public string $expires_at;
    public bool $used = false;
    public string $created_at;
}