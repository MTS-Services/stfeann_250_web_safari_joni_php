<?php

class Auth { 
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
}