<?php
require_once '../model/DAO/UsersDAO.php';
require_once '../model/DAO/EventDAO.php';

class AdminController {
    private $usersDAO;
    private $eventDAO;

    public function __construct() {
        $this->usersDAO = new UsersDAO();
        $this->eventDAO = new EventDAO();
    }

    public function dashboard() {
        $data = [
            'totalUsers' => $this->usersDAO->getTotalUsers(),
            'totalEvents' => $this->eventDAO->getTotalEvents(),
            'users' => $this->usersDAO->getAllUsers()
        ];
        
        require_once '../views/admin/dashboard.php';
    }
}