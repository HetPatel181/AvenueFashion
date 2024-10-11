<?php
session_start();

// Include the database connection file
include('includes/db.php');

// Initialize variables for errors and input values
$emailError = $passwordError = "";
$email = $password = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // 1. Email validation (must be a valid email format)
    if (empty($email)) {
        $emailError = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    }

    // 2. Password validation (must not be empty)
    if (empty($password)) {
        $passwordError = "Password is required.";
    }

    // If no validation errors, proceed to check user credentials
    if (empty($emailError) && empty($passwordError)) {
        // Check if the email exists in the database
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // If user found
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Login successful, store email in session
                $_SESSION['user_email'] = $email; 

                header("Location: profile.php");  // Redirect to user profile or home page
                exit();
            } else {
                $passwordError = "Incorrect password.";
            }
        } else {
            $emailError = "No account found with that email.";
        }
        $stmt->close();
    }
}

// Include the header
include("includes/header.php");
?>

<section class="login-section py-5">
    <div class="container">
        <h1 class="text-center mb-4">Login to Your Account</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="">
                            <!-- Email field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" >
                                <div class="text-danger"><?php echo $emailError; ?></div>
                            </div>

                            <!-- Password field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Enter your password" >
                                <div class="text-danger"><?php echo $passwordError; ?></div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>

                            <div class="mt-3">
                                <a href="#" class="text-secondary">Forgot your password?</a>
                            </div>

                            <div class="mt-3 text-center">
                                <span>Don't have an account? </span>
                                <a href="register.php" class="text-primary">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>
