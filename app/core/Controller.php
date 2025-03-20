<?php
namespace app\core;

use app\core\Session;
use app\core\View;

class Controller {
    protected $session;
    protected $validator;

    public function __construct() {
        $this->session = new Session();
        $this->validator = new Validator();
    }

    protected function render($view, $data = []) {
        View::render($view, $data);
    }

    protected function redirect($url) {
        header("Location: $url");
        exit();
    }

    protected function input($key) {
        return $_REQUEST[$key] ?? null;
    }
}