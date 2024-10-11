<?php
session_start();

// Include the header
include("includes/header.php");

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

// Get the user's email from the session
$userEmail = $_SESSION['user_email'];
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
                    <a href="#changePassword" class="list-group-item list-group-item-action">Change Password</a>
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
                    <form>
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
                <div id="deleteAccount">
                    <h3>Delete Account</h3>
                    <p class="text-danger">Are you sure you want to delete your account? This action cannot be undone.</p>
                    <button class="btn btn-danger">Delete My Account</button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>
