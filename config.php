<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$server = "localhost";
$dbname = "products";
$user = "root";
$pass = "";

try {
    $conn = new PDO(
        "mysql:host=$server;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $conn->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

} catch (PDOException $e) {
    error_log($e->getMessage());
    exit("Greska pri povezivanju s bazom.");
}