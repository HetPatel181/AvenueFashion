<?php
// Include the database connection file
include('../includes/db.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subcategory_name = $_POST['subcategory_name'];

    // Handle the image upload
    if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
        $image = $_FILES['image']['tmp_name'];
        $imageData = file_get_contents($image);
        $imageData = mysqli_real_escape_string($conn, $imageData);
    } else {
        $imageData = null;  // No image uploaded
    }

    // Insert data into the product_subcategory table
    $sql = "INSERT INTO product_subcategories (subcategory_name, image) 
            VALUES ('$subcategory_name', '$imageData')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>New subcategory added successfully.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Subcategory</title>
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
                <h2>Add Product Subcategory</h2>
                <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="subcategory_name" class="form-label">Subcategory Name:</label>
                        <input type="text" id="subcategory_name" name="subcategory_name" class="form-control" required>
                        <div class="invalid-feedback">Please provide a subcategory name.</div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image:</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                        <div class="invalid-feedback">Please upload an image.</div>
                    </div>

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
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
