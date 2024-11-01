<?php
// Include the database connection file
include('../includes/db.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $manufacturer_id = $_POST['manufacturer_id'];
    $category_id = $_POST['category_id'];
    $subcategory_id = $_POST['subcategory_id'];
    $product_price = $_POST['product_price'];
    $product_sale_price = $_POST['product_sale_price'];
    $product_description = $_POST['product_description'];

    // Handle multiple image uploads (up to 3)
    $image1 = isset($_FILES['image1']['tmp_name']) ? file_get_contents($_FILES['image1']['tmp_name']) : null;
    $image2 = isset($_FILES['image2']['tmp_name']) ? file_get_contents($_FILES['image2']['tmp_name']) : null;
    $image3 = isset($_FILES['image3']['tmp_name']) ? file_get_contents($_FILES['image3']['tmp_name']) : null;

    // Insert data into the products table
    $sql = "INSERT INTO products (product_name, manufacturer_id, category_id, subcategory_id, product_price, product_sale_price, product_description, image1, image2, image3) 
            VALUES ('$product_name', '$manufacturer_id', '$category_id', '$subcategory_id', '$product_price', '$product_sale_price', '$product_description', 
            '".mysqli_real_escape_string($conn, $image1)."', '".mysqli_real_escape_string($conn, $image2)."', '".mysqli_real_escape_string($conn, $image3)."')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>New product added successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
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
                <h2>Add New Product</h2>
                <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name:</label>
                        <input type="text" id="product_name" name="product_name" class="form-control" required>
                        <div class="invalid-feedback">Please provide a product name.</div>
                    </div>

                    <!-- Manufacturer Selection -->
                    <div class="mb-3">
                        <label for="manufacturer_id" class="form-label">Select Manufacturer:</label>
                        <select id="manufacturer_id" name="manufacturer_id" class="form-select" required>
                            <option value="">Select Manufacturer</option>
                            <?php
                            $manufacturer_sql = "SELECT id, name FROM manufacturers";
                            $result = $conn->query($manufacturer_sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Please select a manufacturer.</div>
                    </div>

                    <!-- Category Selection -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Select Category:</label>
                        <select id="category_id" name="category_id" class="form-select" required >
                            <option value="">Select Category</option>
                            <?php
                            $category_sql = "SELECT id, category_name FROM product_categories";
                            $result = $conn->query($category_sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Please select a category.</div>
                    </div>

                    <!-- Subcategory Selection (dynamically loaded based on category) -->
                    <div class="mb-3">
                        <label for="subcategory_id" class="form-label">Select Subcategory:</label>
                        <select id="subcategory_id" name="subcategory_id" class="form-select" required>
                            <option value="">Select Subcategory</option>
                            <?php
                            $category_sql = "SELECT id, subcategory_name FROM product_subcategories";
                            $result = $conn->query($category_sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['subcategory_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Product Price -->
                    <div class="mb-3">
                        <label for="product_price" class="form-label">Product Price:</label>
                        <input type="text" id="product_price" name="product_price" class="form-control" required>
                        <div class="invalid-feedback">Please provide a product price.</div>
                    </div>

                    <!-- Product Sale Price -->
                    <div class="mb-3">
                        <label for="product_sale_price" class="form-label">Product Sale Price:</label>
                        <input type="text" id="product_sale_price" name="product_sale_price" class="form-control">
                    </div>

                    <!-- Product Description -->
                    <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description:</label>
                        <textarea id="product_description" name="product_description" class="form-control" rows="4" required></textarea>
                        <div class="invalid-feedback">Please provide a product description.</div>
                    </div>

                    <!-- Image Upload (3 images) -->
                    <div class="mb-3">
                        <label for="image1" class="form-label">Upload Image 1:</label>
                        <input type="file" id="image1" name="image1" class="form-control" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="image2" class="form-label">Upload Image 2:</label>
                        <input type="file" id="image2" name="image2" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="image3" class="form-label">Upload Image 3:</label>
                        <input type="file" id="image3" name="image3" class="form-control" accept="image/*">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <?php include("includes/footer.php"); ?> <!-- Include Footer -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enable Bootstrap validation
        (function () {
            'use strict';
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation');
            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>
