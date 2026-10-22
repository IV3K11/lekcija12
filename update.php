<?php

session_start();

require_once "config.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['update'])) {

    $id = $_POST['id'];

    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];

    $sql = "UPDATE new_users 
            SET username = :username,
                name = :name,
                surname = :surname,
                email = :email
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':email', $email);

    $stmt->execute();

    // Ako korisnik mijenja vlastiti username
    if (
        isset($_SESSION['user_id']) && 
        $id == $_SESSION['user_id']
    ) {
        $_SESSION['username'] = $username;
    }

    header("Location: dashboard.php");
    exit();
}