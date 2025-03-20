<?php
namespace app\Controllers\Events;

use app\core\Controller;
use app\models\services\CountryService;

class CountryController extends Controller {
    private $countryService;

    public function __construct() {
        $this->countryService = new CountryService();
    }

    public function list() {
        $countries = $this->countryService->getAllCountries();
        $this->render('events/countries', ['countries' => $countries]);
    }
}