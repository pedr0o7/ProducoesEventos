<?php
namespace app\core;

class Session {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_name(getenv('SESSION_NAME'));
            session_set_cookie_params([
                'lifetime' => getenv('SESSION_LIFETIME'),
                'path' => '/',
                'secure' => (APP_ENV === 'production'),
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            session_start();
        }
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    public function remove($key) {
        unset($_SESSION[$key]);
    }

    public function destroy() {
        session_unset();
        session_destroy();
        session_write_close();
    }

    public function setFlash($key, $message) {
        $_SESSION['flash'][$key] = $message;
    }

    public function getFlash($key) {
        $message = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $message;
    }

    public function regenerateId() {
        session_regenerate_id(true);
    }
}