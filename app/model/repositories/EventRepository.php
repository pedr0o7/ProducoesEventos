<?php
namespace app\models\repositories;

use app\models\entities\Event;

class EventRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('events', Event::class);
    }

    public function create(Event $event): bool {
        $sql = "INSERT INTO events (
            title, start_datetime, end_datetime, status, 
            cover_image_url, description, organizer_id, 
            address_id, category_id, price, tickets_available
        ) VALUES (
            :title, :start, :end, :status, 
            :cover, :desc, :organizer, 
            :address, :category, :price, :tickets
        )";

        return $this->executeQuery($sql, [
            ':title' => $event->title,
            ':start' => $event->start_datetime->format('Y-m-d H:i:s'),
            ':end' => $event->end_datetime->format('Y-m-d H:i:s'),
            ':status' => $event->status,
            ':cover' => $event->cover_image_url,
            ':desc' => $event->description,
            ':organizer' => $event->organizer_id,
            ':address' => $event->address_id,
            ':category' => $event->category_id,
            ':price' => $event->price,
            ':tickets' => $event->tickets_available
        ])->rowCount() > 0;
    }

    public function getUpcomingEvents(int $limit = 10): array {
        $sql = "SELECT * FROM events 
               WHERE start_datetime > NOW() 
               ORDER BY start_datetime ASC 
               LIMIT :limit";
        
        $stmt = $this->executeQuery($sql, [':limit' => $limit]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
    }
    public function count(): int {
        $sql = "SELECT COUNT(*) FROM events";
        $stmt = $this->executeQuery($sql);
        return $stmt->fetchColumn();
    }

    public function getRecent(int $limit = 5): array {
        $sql = "SELECT * FROM events 
               ORDER BY created_at DESC 
               LIMIT :limit";
        $stmt = $this->executeQuery($sql, [':limit' => $limit]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
    }
}