<?php

session_start();

require_once "config.php";

// Provjera sesije[cite: 10]
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// ID korisnika[cite: 10]
$id = $_GET['id'] ?? $_SESSION["user_id"] ?? null;

if (!$id) {
    die("User ID is missing!");
}

// Preuzimanje korisnika iz baze[cite: 10]
$sql = "SELECT * FROM new_users WHERE id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found!");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>

    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">

        <h2>Edit Profile</h2>

        <form action="update.php" method="POST">
            
            <input 
                type="hidden" 
                name="id" 
                value="<?php echo $user['id']; ?>"
            >

            <div class="mb-3">
                <label>Username</label>
                <input 
                    type="text" 
                    name="username" 
                    class="form-control" 
                    value="<?php echo htmlspecialchars($user['username']); ?>" 
                    required
                >
            </div>

            <div class="mb-3">
                <label>Name</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control" 
                    value="<?php echo htmlspecialchars($user['name']); ?>" 
                    required
                >
            </div>

            <div class="mb-3">
                <label>Surname</label>
                <input 
                    type="text" 
                    name="surname" 
                    class="form-control" 
                    value="<?php echo htmlspecialchars($user['surname']); ?>" 
                    required
                >
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control" 
                    value="<?php echo htmlspecialchars($user['email']); ?>" 
                    required
                >
            </div>

            <button type="submit" name="update" class="btn btn-success">
                Save Changes
            </button>

            <a href="dashboard.php" class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>
</div>

</body>
</html>