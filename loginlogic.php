<?php

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}

$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";

if ($username === "" || $password === "") {
    exit("Popunite sve polja!");
}

// Pronalazimo korisnika u bazi
$sql = "SELECT * FROM new_users
        WHERE username = :username";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ":username" => $username
]);

$user = $stmt->fetch();

// Provjeravamo korisnicko ime i lozinku
if (
    $user &&
    password_verify($password, $user["password"])
) {
    // Novi session ID nakon uspjesne prijave
    session_regenerate_id(true);

    // Spremamo podatke u sesiju
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["name"] = $user["name"];

    header("Location: dashboard.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}