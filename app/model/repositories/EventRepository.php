<?php 

    require_once "Database.php";
    require_once "../model/DTO/EventDTO.php";
    class EventDAO{
        //ativar conexão com banco
        public $pdo = null;

        public function __construct(){
            $this->pdo = Database::getInstance();
        }

        public function getTotalEvents() {
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM events");
            return $stmt->fetchColumn();
        }
    
        public function getEventsByOrganizer($organizerId) {
            $stmt = $this->pdo->prepare("SELECT * FROM events WHERE organizer_id = ?");
            $stmt->execute([$organizerId]);
            return $stmt->fetchAll();
        }

        public function getAvailableEvents()
        {
            $stmt = $this->pdo->query("SELECT * FROM events where status = ? ");
            $status = "published";
            $stmt->execute([$status]);
            return $stmt->fetchColumn();
        }

    }


?>