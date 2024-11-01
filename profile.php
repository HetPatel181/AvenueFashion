<?php
session_start();
include("includes/header.php");
include('includes/db.php'); // Include the database connection

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

// Get the user's email from the session
$userEmail = $_SESSION['user_email'];

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Fetch the user's current password from the database
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the current password
        if (password_verify($currentPassword, $row['password'])) {
            // Check if new passwords match
            if ($newPassword === $confirmPassword) {
                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                // Update the password in the database
                $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
                $updateStmt->bind_param("ss", $hashedPassword, $userEmail);
                
                if ($updateStmt->execute()) {
                    // Set a session message and redirect to login
                    $_SESSION['message'] = "Password changed successfully. Please log in again.";
                    session_destroy();
                    header("Location: login.php");
                    exit();
                } else {
                    $passwordChangeMessage = "Error updating password: " . $conn->error;
                }
            } else {
                $passwordChangeMessage = "New passwords do not match.";
            }
        } else {
            $passwordChangeMessage = "Current password is incorrect.";
        }
    } else {
        $passwordChangeMessage = "User not found.";
    }
}

// Handle account deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account'])) {
    // Delete the user from the database
    $deleteStmt = $conn->prepare("DELETE FROM users WHERE email = ?");
    $deleteStmt->bind_param("s", $userEmail);
    
    if ($deleteStmt->execute()) {
        // Destroy the session and redirect to the registration page
        session_destroy();
        header("Location: register.php");
        exit();
    } else {
        $deleteAccountMessage = "Error deleting account: " . $conn->error;
    }
}
?>

<section class="profile-section py-5">
    <div class="container">
        <h1 class="text-center mb-4">My Profile</h1>
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="text-center mb-4">
                    <img src="images/profile.png" alt="Profile Image" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                    <h4 class="mt-2">Parth Savaliya</h4>
                    <p><?php echo htmlspecialchars($userEmail); ?></p> <!-- Displaying user's email -->
                </div>
                <div class="list-group">
                    <a href="#myOrders" class="list-group-item list-group-item-action">My Orders</a>  
                    <a href="#myWishlist" class="list-group-item list-group-item-action">My Wishlist</a>
                    <a href="#changePassword" class="list-group-item list-group-item-action active">Change Password</a>
                    <a href="#deleteAccount" class="list-group-item list-group-item-action text-danger">Delete Account</a>
                    <a href="logout.php" class="list-group-item list-group-item-action text-warning">Logout</a>
                </div>
            </div>
            <div class="col-md-8">
                <div id="myOrders" class="mb-4">
                    <h3>My Orders</h3>
                    <ul class="list-group">
                        <li class="list-group-item">Order #1234 - $99.99 <span class="badge bg-secondary">Completed</span></li>
                        <li class="list-group-item">Order #1235 - $49.99 <span class="badge bg-secondary">Pending</span></li>
                        <!-- Add more orders as needed -->
                    </ul>
                </div>
                <div id="myWishlist" class="mb-4">
                    <h3>My Wishlist</h3>
                    <ul class="list-group">
                        <li class="list-group-item">Product Name 1 - $29.99 <button class="btn btn-link">Add to Cart</button></li>
                        <li class="list-group-item">Product Name 2 - $39.99 <button class="btn btn-link">Add to Cart</button></li>
                        <!-- Add more wishlist items as needed -->
                    </ul>
                </div>
                <div id="changePassword" class="mb-4">
                    <h3>Change Password</h3>
                    <?php if (isset($passwordChangeMessage)) : ?>
                        <div class="alert alert-info"><?php echo $passwordChangeMessage; ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <button type="submit" name="change_password" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
                <div id="deleteAccount">
                    <h3>Delete Account</h3>
                    <?php if (isset($deleteAccountMessage)) : ?>
                        <div class="alert alert-danger"><?php echo $deleteAccountMessage; ?></div>
                    <?php endif; ?>
                    <p class="text-danger">Are you sure you want to delete your account? This action cannot be undone.</p>
                    <form method="post" onsubmit="return confirmDelete();">
                        <button type="submit" name="delete_account" class="btn btn-danger">Delete My Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete your account? This action cannot be undone.");
    }
</script>

<?php
include("includes/footer.php");
?>
