<?php
include("includes/header.php");
include('../includes/db.php'); // Include the database connection

// Fetch all users from the database
$sql = "SELECT id, full_name, email, phone FROM users";
$result = $conn->query($sql);
?>

<div class="row">
    <div class="col-md-2">
        <?php include("includes/sidebar.php"); ?> <!-- Admin Sidebar -->
    </div>
    <div class="col-md-10">
        <h1>All Users</h1>
        <table class="table table-striped table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output each row of data
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['full_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include("includes/footer.php");
$conn->close(); // Close the database connection
?>
