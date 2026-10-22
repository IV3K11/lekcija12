<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$product = [
    'id' => '',
    'title' => '',
    'description' => '',
    'quantity' => '',
    'price' => ''
];

$isUpdate = false;

if (isset($_GET['id'])) {
    $isUpdate = true;
    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product not found!");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $isUpdate ? 'Update Product' : 'Add Product'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow p-4">
        <h2><?php echo $isUpdate ? 'Update Product' : 'Add New Product'; ?></h2>
        <hr>

        <form action="updateProduct.php" method="POST">
            
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($product['title']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="<?php echo $product['quantity']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
            </div>

            <button type="submit" class="btn btn-success">
                <?php echo $isUpdate ? 'Save Changes' : 'Add Product'; ?>
            </button>

            <a href="productDashboard.php" class="btn btn-secondary">Back</a>

        </form>
    </div>
</div>

</body>
</html>