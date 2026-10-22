<?php

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: signup.php");
    exit;
}

$name = trim($_POST["name"] ?? "");
$surname = trim($_POST["surname"] ?? "");
$username = trim($_POST["username"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if (
    $name === "" ||
    $surname === "" ||
    $username === "" ||
    $email === "" ||
    $password === ""
) {
    exit("Morate popuniti sva polja!");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Neispravna e-mail adresa!");
}

if (strlen($password) < 8) {
    exit("Lozinka mora imati najmanje 8 znakova!");
}

// Provjera da li korisnik vec postoji
$sql = "SELECT id FROM new_users
        WHERE username = :username
        OR email = :email";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ":username" => $username,
    ":email" => $email
]);

if ($stmt->fetch()) {
    exit("Korisnicko ime ili e-mail vec postoji!");
}

// Hashiranje lozinke
$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

// Spremanje korisnika u bazu
$sql = "INSERT INTO new_users
        (name, surname, username, email, password)
        VALUES
        (:name, :surname, :username, :email, :password)";

$stmt = $conn->prepare($sql);

try {
    $stmt->execute([
        ":name" => $name,
        ":surname" => $surname,
        ":username" => $username,
        ":email" => $email,
        ":password" => $hashedPassword
    ]);
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit("Registracija nije uspjela.");
}

header("Location: login.php?registered=1");
exit;