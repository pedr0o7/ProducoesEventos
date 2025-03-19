<?php
require_once '../model/DAO/EventDAO.php';
require_once '../model/DAO/TicketDAO.php';

require_once '../model/DTO/EventDTO.php';
require_once '../model/DTO/TicketDTO.php';

class UserController {
    private $eventDAO;
    private $ticketDAO;

    public function __construct() {
        $this->eventDAO = new EventDAO();
        $this->ticketDAO = new TicketDAO();
    }

    public function dashboard() {
        $data = [
            'events' => $this->eventDAO->getAvailableEvents()
        ];
        require_once '../views/user/dashboard.php';
    }

    public function purchaseTicket($ticketData) {
        $ticketDTO = new TicketDTO();
        $ticketDTO->setEvent_id($ticketData['event_id']);
        $ticketDTO->setUser_id($_SESSION['user_id']);
        
        return $this->ticketDAO->createTicket($ticketDTO);
    }
}