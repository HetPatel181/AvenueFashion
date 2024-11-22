<?php
session_start();
include('../includes/db.php'); // Include the database connection

// Handle delete request
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM manufacturers WHERE id = ?");
    $stmt->bind_param("i", $deleteId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Manufacturer deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting manufacturer.";
    }
    header("Location: view_manufacture.php");
    exit();
}

// Fetch all manufacturers from the database
$result = $conn->query("SELECT * FROM manufacturers");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Manufacturers</title>
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
                <h2 class="mt-4 text-center">View Manufacturers</h2>
                <div class="container mt-5">
                    <?php if (isset($_SESSION['message'])) : ?>
                        <div class="alert alert-info"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
                    <?php endif; ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0) : ?>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['contact_number']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                                        <td>
                                            <?php if (!empty($row['image'])) : ?>
                                                <!-- Display the image -->
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" 
                                                     alt="Manufacturer Image" style="width: 100px; height: auto;">
                                            <?php else : ?>
                                                <!-- Placeholder if no image -->
                                                <img src="https://via.placeholder.com/100" alt="No Image" style="width: 100px; height: auto;">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="update_manufacture.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Update</a>
                                            <a href="view_manufacture.php?delete_id=<?php echo $row['id']; ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Are you sure you want to delete this manufacturer?');">
                                               Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="text-center">No manufacturers found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php include("includes/footer.php"); ?> <!-- Include Footer -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
