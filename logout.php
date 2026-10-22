<?php

require_once "config.php";

// Brisanje podataka iz sesije
$_SESSION = [];

// Brisanje session cookieja
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Zavrsavanje sesije
session_destroy();

// Povratak na Login
header("Location: login.php");
exit;