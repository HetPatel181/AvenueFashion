<?php
session_start();
include('../includes/db.php'); // Include the database connection

// Handle the delete operation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM product_categories WHERE id = ?";

    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Category deleted successfully.';
        } else {
            $_SESSION['message'] = 'Error deleting category.';
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = 'Error preparing delete statement.';
    }
    header("Location: view_categories.php"); // Redirect to refresh page
    exit;
}

// Fetch categories
$query = "SELECT id, category_name, description, image FROM product_categories";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories</title>
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
                <h2 class="mt-4">View Categories</h2>
                <div class="container mt-5">
                    <h1 class="text-center">Categories</h1>
                    <?php if (isset($_SESSION['message'])) : ?>
                        <div class="alert alert-info"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
                    <?php endif; ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Category Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0) : ?>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                                        <td>
                                            <?php if ($row['image']) : ?>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" width="100" height="100" />
                                            <?php else : ?>
                                                <p>No Image</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="update_category.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Update</a>
                                            <a href="view_categories.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">No categories found.</td>
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
