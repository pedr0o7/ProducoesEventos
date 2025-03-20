<?php
namespace app\models\services;

use app\models\repositories\EventRepository;
use app\models\entities\Event;

class EventService {
    private $repo;

    public function __construct() {
        $this->repo = new EventRepository();
    }

    public function createEvent(Event $event): bool {
        return $this->repo->create($event);
    }

    public function getEventDetails(int $id): ?Event {
        return $this->repo->findById($id);
    }

    public function getUpcomingEvents(): array {
        return $this->repo->getUpcomingEvents();
    }
}