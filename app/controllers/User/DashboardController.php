<?php
namespace app\Controllers\User;

use app\core\Controller;
use app\models\services\TicketService;
use app\models\repositories\TicketRepository;

class DashboardController extends Controller {
    private $ticketService;
    private $ticketRepository;

    public function __construct() {
        $this->ticketService = new TicketService();
        $this->ticketRepository = new TicketRepository();
    }

    public function index() {
        $tickets = $this->ticketRepository ->getUserTickets($_SESSION['user_id']);
        $this->render('user/userDashboard', ['tickets' => $tickets]);
    }
}