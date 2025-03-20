<?php
namespace app\Controllers\Events;

use app\core\Controller;
use app\models\services\EventService;

class EventController extends Controller {
    private $eventService;

    public function __construct() {
        $this->eventService = new EventService();
    }

    public function index() {
        $events = $this->eventService->getUpcomingEvents();
        $this->render('events/list', ['events' => $events]);
    }

    public function show($id) {
        $event = $this->eventService->getEventDetails($id);
        $this->render('events/detail', ['event' => $event]);
    }
}