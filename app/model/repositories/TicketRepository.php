<?php
require_once 'Database.php';
require_once '../DTO/TicketDTO.php';

class TicketDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function createTicket(TicketDTO $ticket) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO tickets (type,quantity_available,event_id, user_id)
                VALUES (:type,:quantity_available,:event_id, :user_id)
            ");
            
            $stmt->execute([
                ':type' => $ticket->gettype(),
                ':event_id' => $ticket->getEvent_Id(),
                ':user_id' => $ticket->getUser_Id(),
                ':quantity_available' => $ticket->getQuantity_available()
            ]);
            
            return $this->pdo->lastInsertId();
            
        } catch(PDOException $e) {
            error_log("Erro ao criar ticket: " . $e->getMessage());
            return false;
        }
    }

    public function getTicketsByUser($userId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM tickets 
                WHERE user_id = :user_id
            ");
            
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'TicketDTO');
            
        } catch(PDOException $e) {
            error_log("Erro ao buscar tickets: " . $e->getMessage());
            return [];
        }
    }

    public function getSoldTicketsByEvent($eventId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT SUM(quantity) as total 
                FROM tickets 
                WHERE event_id = :event_id
            ");
            
            $stmt->execute([':event_id' => $eventId]);
            return $stmt->fetchColumn();
            
        } catch(PDOException $e) {
            error_log("Erro ao contar ingressos: " . $e->getMessage());
            return 0;
        }
    }

    public function updateTicketQuantity($ticketId, $newQuantity) {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE tickets 
                SET quantity = :quantity 
                WHERE ticket_id = :ticket_id
            ");
            
            return $stmt->execute([
                ':quantity' => $newQuantity,
                ':ticket_id' => $ticketId
            ]);
            
        } catch(PDOException $e) {
            error_log("Erro ao atualizar ticket: " . $e->getMessage());
            return false;
        }
    }
}