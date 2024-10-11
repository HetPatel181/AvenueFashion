<?php
session_start();

// Include the database connection file
include('includes/db.php');

// Initialize an error array to store validation errors
$errors = [];
$fullNameError = $emailError = $passwordError = $phoneError = "";
$fullName = $email = $password = $phone = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone']);

    // 1. Full Name validation (should only contain letters and spaces)
    if (empty($fullName)) {
        $fullNameError = "Full Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $fullName)) {
        $fullNameError = "Full Name should only contain letters and spaces.";
    }

    // 2. Email validation (must be a valid email format)
    if (empty($email)) {
        $emailError = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    } else {
        // Check if the email already exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $emailError = "Email is already taken.";
        }
        $stmt->close(); // Close the statement
    }

    // 3. Password validation (at least 6 characters long)
    if (empty($password)) {
        $passwordError = "Password is required.";
    } elseif (strlen($password) < 6) {
        $passwordError = "Password must be at least 6 characters long.";
    }

    // 4. Phone Number validation (should only contain digits and be 10 digits long)
    if (empty($phone)) {
        $phoneError = "Phone Number is required.";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $phoneError = "Phone Number must be 10 digits.";
    }

    // If no validation errors, proceed with saving data to the database
    if (empty($fullNameError) && empty($emailError) && empty($passwordError) && empty($phoneError)) {
        // Hash the password before saving
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullName, $email, $hashed_password, $phone);

        // Execute the statement and check if successful
        if ($stmt->execute()) {
            // Registration successful, redirect to login
            header("Location: login.php");
            exit();
        } else {
            $errors[] = "Registration failed: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Include the header
include("includes/header.php");
?>

<section class="register-section py-5">
    <div class="container">
        <h1 class="text-center mb-4">Create Your Account</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="">

                            <!-- Full Name field -->
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" 
                                       placeholder="Enter your full name" 
                                       value="<?php echo htmlspecialchars($fullName); ?>" >
                                <div class="text-danger"><?php echo $fullNameError; ?></div>
                            </div>

                            <!-- Email field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="Enter your email" 
                                       value="<?php echo htmlspecialchars($email); ?>" >
                                <div class="text-danger"><?php echo $emailError; ?></div>
                            </div>

                            <!-- Password field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Create a password" >
                                <div class="text-danger"><?php echo $passwordError; ?></div>
                            </div>

                            <!-- Phone Number field -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                       placeholder="Enter your phone number" 
                                       value="<?php echo htmlspecialchars($phone); ?>" >
                                <div class="text-danger"><?php echo $phoneError; ?></div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Create Account</button>
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
