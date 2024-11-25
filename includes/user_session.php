<?php
class UserSession {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function getCurrentUser() {
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    public function setCurrentUser($user) {
        $_SESSION['user'] = $user;
    }

    public function closeSession() {
        session_unset();
        session_destroy();
    }
}
