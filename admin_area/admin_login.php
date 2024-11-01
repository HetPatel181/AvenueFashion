<?php
session_start();
include('../includes/db.php');

$emailError = $passwordError = $loginError = "";
$email = $password = "";

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Basic validation
    if (empty($email)) {
        $emailError = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    }

    if (empty($password)) {
        $passwordError = "Password is required.";
    }

    if (empty($emailError) && empty($passwordError)) {
        // Check email in the database for admin
        $stmt = $conn->prepare("SELECT id, password FROM admins WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($admin_id, $db_password);
            $stmt->fetch();
            
            // Directly compare input password with the database password (both in plain text)
            if ($password === $db_password) {
                // Set session variables for authenticated admin
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_email'] = $email;
                header("Location: index.php");
                exit();
            } else {
                $loginError = "Invalid credentials.";
            }
        } else {
            $loginError = "No admin found with that email.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- External Custom CSS for Admin Login -->
    <link rel="stylesheet" href="css/admin_login.css">
</head>
<body>

<div class="login-container">
    <div class="login-form">
        <h2 class="text-center">Admin Login</h2>

        <?php if (!empty($loginError)): ?>
            <div class="alert alert-danger"><?php echo $loginError; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <!-- Email field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>
                <div class="text-danger"><?php echo $emailError; ?></div>
            </div>

            <!-- Password field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                <div class="text-danger"><?php echo $passwordError; ?></div>
            </div>

            <!-- Submit button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
