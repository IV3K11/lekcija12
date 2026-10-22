<?php

session_start();

require_once "config.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;

    if (!$id) {
        die("User ID is missing!");
    }

    $sql = "DELETE FROM new_users WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}