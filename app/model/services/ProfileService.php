<?php
namespace app\models\services;

use app\models\repositories\UsersRepository;
use app\models\repositories\ProfileRepository;
use app\core\Session;
use app\core\Validator;

class ProfileService {
    private $repo;
    private $session;
    private $validator;

    public function __construct() {
        $this->repo = new ProfileRepository();
        $this->userRepo = new UsersRepository(); 
        $this->session = new Session();
        $this->validator = new Validator();
    }

    public function getProfile(int $userId): ?Profile {
        return $this->repo->findById($userId);
    }

    public function updateUserPassword(int $userId, string $newPassword): bool {
        $user = $this->userRepo->findById($userId);
        $user->password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->userRepo->update($user);
    }
    public function updateProfile(int $userId, array $data): array {
        $validationRules = [
            'name' => 'required|max:100',
            'bio' => 'max:500',
            'website' => 'url|max:200',
            'phone' => 'regex:/^\+?[0-9\s\-()]+$/'
        ];

        if (!$this->validator->validate($data, $validationRules)) {
            return ['success' => false, 'errors' => $this->validator->errors()];
        }

        if ($this->repo->updateProfile($userId, $data)) {
            $this->session->setFlash('success', 'Perfil atualizado!');
            return ['success' => true];
        }

        return ['success' => false, 'errors' => ['general' => 'Erro ao atualizar']];
    }

    public function updateProfileImage(int $userId, array $file): array {
        // Implementar lógica de upload
        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'error' => 'Tipo de arquivo inválido'];
        }

        if ($file['size'] > $maxSize) {
            return ['success' => false, 'error' => 'Arquivo muito grande (max 2MB)'];
        }

        $newFileName = 'profile_' . $userId . '_' . time() . '.jpg';
        $uploadPath = __DIR__ . '/../../public/assets/uploads/' . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $this->repo->updateProfileImage($userId, '/assets/uploads/' . $newFileName);
            return ['success' => true, 'path' => $newFileName];
        }

        return ['success' => false, 'error' => 'Erro no upload'];
    }
}