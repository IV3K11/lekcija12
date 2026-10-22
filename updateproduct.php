<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $quantity = $_POST['quantity'] ?? 0;
    $price = $_POST['price'] ?? 0;

    if ($title === '' || $description === '') {
        die("Title and description are required!");
    }

    if (!empty($id)) {
        $sql = "UPDATE products 
                SET title = :title, 
                    description = :description, 
                    quantity = :quantity, 
                    price = :price 
                WHERE id = :id";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':quantity' => $quantity,
            ':price' => $price,
            ':id' => $id
        ]);
    } else {
        $sql = "INSERT INTO products (title, description, quantity, price) 
                VALUES (:title, :description, :quantity, :price)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':quantity' => $quantity,
            ':price' => $price
        ]);
    }

    header("Location: productDashboard.php");
    exit();
} else {
    header("Location: productDashboard.php");
    exit();
}