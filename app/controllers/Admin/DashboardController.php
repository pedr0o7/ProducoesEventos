<?php
namespace app\Controllers\Admin;

use app\core\Controller;
use app\models\repositories\EventRepository;
use app\models\repositories\UsersRepository;

class DashboardController extends Controller {
    public function index() {
        // Dados para o dashboard admin
        $eventRepo = new EventRepository();
        $userRepo = new UsersRepository();
        
        $data = [
            'totalEvents' => $eventRepo->count(),
            'totalUsers' => $userRepo->count(),
            'recentEvents' => $eventRepo->getRecent(5)
        ];
        
        $this->render('admin/adminDashboard', $data);
    }
}