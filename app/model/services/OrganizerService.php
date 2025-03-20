<?php
namespace app\models\services;

use app\models\repositories\OrganizerRepository;
use app\models\entities\Organizer;

class OrganizerService {
    private $repo;

    public function __construct() {
        $this->repo = new OrganizerRepository();
    }

    public function registerOrganizer(Organizer $organizer): bool {
        // Validação específica para CNPJ
        return $this->repo->createWithCNPJ($organizer);
    }

    public function getPendingApprovals(): array {
        return $this->repo->findPendingApprovals();
    }

    public function approve(int $id): bool {
        return $this->repo->approveOrganizer($id);
    }
}