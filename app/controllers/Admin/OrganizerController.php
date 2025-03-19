<?php
require_once '../model/DAO/EventDAO.php';

class OrganizerController {
    private $eventDAO;

    public function __construct() {
        $this->eventDAO = new EventDAO();
    }

    public function dashboard() {
        $organizerId = $_SESSION['user_id'];
        $data = [
            'events' => $this->eventDAO->getEventsByOrganizer($organizerId)
        ];
        
        require_once '../views/organizer/dashboard.php';
    }

    public function createEvent($eventData) {
        $eventDTO = new EventDTO();
        $eventDTO->setTitle($eventData['title']);
        $eventDTO->setDescription($eventData['description']);
        $eventDTO->setStart_datetime($eventData['start_datetime']);
        $eventDTO->setEnd_datetime($eventData['end_datetime']);
        $eventDTO->setStatus($eventData['status']);
        $eventDTO->setCover_image_url($eventData['cover_image_url']);
        $eventDTO->setOrganizer_id($eventData['organizer_id']);
        $eventDTO->setAdress_id($eventData['adress_id']);
        $eventDTO->setCategory_id($eventData['category_id']);
        $eventDTO->setPrice($eventData['price']);
        $eventDTO->setTickets_available($eventData['tickets_available']);  
        return $eventDTO->setEvent($eventDTO);
    }
}