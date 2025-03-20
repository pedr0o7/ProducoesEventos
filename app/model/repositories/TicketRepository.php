<?php
namespace app\models\repositories;

use app\models\entities\Ticket;

class TicketRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('tickets', Ticket::class);
    }

    public function getAvailableTickets(int $eventId): array {
        $sql = "SELECT * FROM tickets 
               WHERE event_id = :eventId 
               AND quantity_available > 0
               AND sale_start <= NOW() 
               AND sale_end >= NOW()";
        
        $stmt = $this->executeQuery($sql, [':eventId' => $eventId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
    }
    public function update(Ticket $ticket): bool {
        $sql = "UPDATE tickets SET 
                type = :type,
                quantity_available = :quantity,
                sale_start = :start,
                sale_end = :end,
                max_per_order = :max
                WHERE ticket_id = :id";
        
        return $this->executeQuery($sql, [
            ':type' => $ticket->type,
            ':quantity' => $ticket->quantity_available,
            ':start' => $ticket->sale_start,
            ':end' => $ticket->sale_end,
            ':max' => $ticket->max_per_order,
            ':id' => $ticket->ticket_id
        ])->rowCount() > 0;
    }

    public function getUserTickets(int $userId): array {
        $sql = "SELECT * FROM tickets WHERE user_id = :userId";
        $stmt = $this->executeQuery($sql, [':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
    }
}