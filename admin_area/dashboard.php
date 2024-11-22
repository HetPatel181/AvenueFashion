<?php
session_start();
include('../includes/db.php'); // Include the database connection

// Fetch total number of products
$product_query = "SELECT COUNT(*) AS total_products FROM products";
$product_result = $conn->query($product_query);
$product_count = $product_result->fetch_assoc()['total_products'];

// Fetch total number of categories
$category_query = "SELECT COUNT(*) AS total_categories FROM product_categories";
$category_result = $conn->query($category_query);
$category_count = $category_result->fetch_assoc()['total_categories'];

// Fetch total number of subcategories
$subcategory_query = "SELECT COUNT(*) AS total_subcategories FROM product_subcategories";
$subcategory_result = $conn->query($subcategory_query);
$subcategory_count = $subcategory_result->fetch_assoc()['total_subcategories'];

// Fetch total number of users
$user_query = "SELECT COUNT(*) AS total_users FROM users";
$user_result = $conn->query($user_query);
$user_count = $user_result->fetch_assoc()['total_users'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin: 20px 0;
        }
        .card-body {
            font-size: 24px;
            text-align: center;
        }
        .card-title {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <?php include("includes/header.php"); ?> <!-- Include Header -->

        <div class="row">
            <div class="col-md-2">
                <?php include("includes/sidebar.php"); ?> <!-- Admin Sidebar -->
            </div>
            <div class="col-md-10">
                <h2 class="mt-4">Dashboard</h2>

                <div class="row mt-5">
                    <!-- Total Products Card -->
                    <div class="col-md-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Total Products</h5>
                                <p class="card-text"><?php echo $product_count; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Categories Card -->
                    <div class="col-md-3">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Total Categories</h5>
                                <p class="card-text"><?php echo $category_count; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Subcategories Card -->
                    <div class="col-md-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Total Subcategories</h5>
                                <p class="card-text"><?php echo $subcategory_count; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Users Card -->
                    <div class="col-md-3">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text"><?php echo $user_count; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?> <!-- Include Footer -->
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
