<?php
namespace app\models\entities;

class Profile extends Users {
    public ?string $bio = null;
    public ?string $website = null;
    public ?string $social_facebook = null;
    public ?string $social_instagram = null;
    public ?string $profile_image = null;
    public ?string $phone = null;

    // public function __construct() {
    //     parent::__construct();
    // }
}