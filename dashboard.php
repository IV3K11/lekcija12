<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM new_users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
        </span>
        <a href="logout.php" class="btn btn-outline-light">Sign out</a>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar">
            <h5 class="mt-4 ms-3">Menu</h5>
            <a href="dashboard.php">Dashboard</a>
            <a href="productDashboard.php">Products Dashboard</a>
            <a href="profile.php">Edit Profile</a>
        </div>

        <div class="col-md-10 main-content">
            <div class="row">
                <div class="col-md-12 main-content">
                    
                    <h2>Dashboard</h2>
                    <hr>

                    <h4 class="mt-4">All Registered Users</h4>

                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td>
                                        <a href="profile.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-primary">Update</a>
                                        <form action="delete.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>