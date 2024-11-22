<?php
session_start();
include('../includes/db.php'); // Include the database connection

// Handle the delete operation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM products WHERE id = ?";

    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Product deleted successfully.';
        } else {
            $_SESSION['message'] = 'Error deleting product.';
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = 'Error preparing delete statement.';
    }
    header("Location: view_product.php"); // Redirect to refresh page
    exit;
}

// Fetch products with their associated category and manufacturer information
$query = "SELECT p.id, p.product_name, p.manufacturer_id, p.category_id, p.subcategory_id, p.product_price, p.product_sale_price, p.product_description, 
                 p.image1, p.image2, p.image3, pc.category_name, m.name 
          FROM products p
          JOIN product_categories pc ON p.category_id = pc.id
          JOIN manufacturers m ON p.manufacturer_id = m.id"; // assuming 'manufacturers' table exists
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <?php include("includes/header.php"); ?> <!-- Include Header -->

        <div class="row">
            <div class="col-md-2">
                <?php include("includes/sidebar.php"); ?> <!-- Admin Sidebar -->
            </div>
            <div class="col-md-10">
                <h2 class="mt-4">View Products</h2>
                <div class="container mt-5">
                    <h1 class="text-center">Products</h1>
                    <?php if (isset($_SESSION['message'])) : ?>
                        <div class="alert alert-info"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
                    <?php endif; ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Manufacturer</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Description</th>
                                <th>Image 1</th>
                                <th>Image 2</th>
                                <th>Image 3</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0) : ?>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['product_price']); ?></td>
                                        <td><?php echo htmlspecialchars($row['product_sale_price']); ?></td>
                                        <td><?php echo htmlspecialchars($row['product_description']); ?></td>
                                        <td>
                                            <?php if ($row['image1']) : ?>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image1']); ?>" width="100" height="100" />
                                            <?php else : ?>
                                                <p>No Image</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['image2']) : ?>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image2']); ?>" width="100" height="100" />
                                            <?php else : ?>
                                                <p>No Image</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['image3']) : ?>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image3']); ?>" width="100" height="100" />
                                            <?php else : ?>
                                                <p>No Image</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="update_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Update</a>
                                            <a href="view_product.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="12" class="text-center">No products found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <?php
    include("includes/footer.php");
    ?>
</body>
</html>
