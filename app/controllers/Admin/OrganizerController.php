<?php
namespace app\Controllers\Admin;

use app\core\Controller;
use app\models\services\OrganizerService;

class OrganizerController extends Controller {
    private $organizerService;

    public function __construct() {
        $this->organizerService = new OrganizerService();
    }

    public function index() {
        $organizers = $this->organizerService->getPendingApprovals();
        $this->render('admin/organizers/list', ['organizers' => $organizers]);
    }

    public function approve($id) {
        $this->organizerService->approve($id);
        $this->redirect('/admin/organizers');
    }
}