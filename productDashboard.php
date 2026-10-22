<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
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

        <div class="col-md-10 dashboard-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Products Management</h2>
                <a href="product.php" class="btn btn-success">Add Product</a>
            </div>
            
            <hr>

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($products) > 0): ?>
                        <?php foreach ($products as $prod): ?>
                            <tr>
                                <td><?php echo $prod['id']; ?></td>
                                <td><?php echo htmlspecialchars($prod['title']); ?></td>
                                <td><?php echo htmlspecialchars($prod['description']); ?></td>
                                <td><?php echo $prod['quantity']; ?></td>
                                <td><?php echo $prod['price']; ?></td>
                                <td>
                                    <a href="product.php?id=<?php echo $prod['id']; ?>" class="btn btn-sm btn-primary">Update</a>
                                    
                                    <form action="deleteProduct.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No products found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>