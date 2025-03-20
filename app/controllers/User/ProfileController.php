<?php
namespace app\Controllers\User;

use app\core\Controller;
use app\models\services\ProfileService;

class ProfileController extends Controller {
    private $profileService;

    public function __construct() {
        $this->profileService = new ProfileService();
    }

    public function edit() {
        $userId = $this->session->get('user.id');
        $profile = $this->profileService->getProfile($userId);
        $this->render('user/profile/edit', ['profile' => $profile]);
    }

    public function update() {
        $userId = $this->session->get('user.id');
        $result = $this->profileService->updateProfile($userId, $_POST);
        
        if ($result['success']) {
            $this->redirect('/user/profile');
        } else {
            $this->render('user/profile/edit', ['errors' => $result['errors']]);
        }
    }

    public function updateImage() {
        $userId = $this->session->get('user.id');
        $result = $this->profileService->updateProfileImage($userId, $_FILES['avatar']);
        
        if ($result['success']) {
            $this->redirect('/user/profile');
        } else {
            $this->session->setFlash('error', $result['error']);
            $this->redirect('/user/profile/edit');
        }
    }
}