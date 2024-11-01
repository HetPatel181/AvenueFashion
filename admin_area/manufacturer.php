<?php
// Include the database connection file
include('../includes/db.php');

// Handle file upload and form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $product_type = $_POST['product_type'];

    // Handle the image upload
    $image = $_FILES['image']['tmp_name'];
    $imageData = file_get_contents($image);
    $imageData = mysqli_real_escape_string($conn, $imageData);

    // Insert data into the database
    $sql = "INSERT INTO manufacturers (name, address, contact_number, email, product_type, image) 
            VALUES ('$name', '$address', '$contact_number', '$email', '$product_type', '$imageData')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>New manufacturer record created successfully.</div>";
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
    <title>Add Manufacturer</title>
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
                <h2>Add Manufacturer</h2>
                <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">Manufacturer Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                        <div class="invalid-feedback">Please provide a manufacturer name.</div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" id="address" name="address" class="form-control" required>
                        <div class="invalid-feedback">Please provide an address.</div>
                    </div>

                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number:</label>
                        <input type="text" id="contact_number" name="contact_number" class="form-control" required>
                        <div class="invalid-feedback">Please provide a contact number.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                        <div class="invalid-feedback">Please provide a valid email.</div>
                    </div>

                    <div class="mb-3">
                        <label for="product_type" class="form-label">Product Type:</label>
                        <input type="text" id="product_type" name="product_type" class="form-control" required>
                        <div class="invalid-feedback">Please provide a product type.</div>
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
        // Example JavaScript to enable Bootstrap validation styles
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
