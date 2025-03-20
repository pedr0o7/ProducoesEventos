<?php
namespace app\models\services;

use app\models\repositories\TicketRepository;
use app\models\entities\Ticket;

class TicketService {
    private $repo;

    public function __construct() {
        $this->repo = new TicketRepository();
    }

    public function getAvailableTickets(int $eventId): array {
        return $this->repo->getAvailableTickets($eventId);
    }

    public function reserveTicket(Ticket $ticket, int $quantity): bool {
        if ($ticket->quantity_available >= $quantity) {
            $ticket->quantity_available -= $quantity;
            return $this->repo->update($ticket);
        }
        return false;
    }
    
}