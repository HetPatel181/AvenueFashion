<?php
session_start();

include("includes/header.php");

// Initialize variables for errors and input values
$nameError = $emailError = $subjectError = $messageError = "";
$name = $email = $subject = $message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // 1. Full Name validation
    if (empty($name)) {
        $nameError = "Full name is required.";
    }

    // 2. Email validation (must be a valid email format)
    if (empty($email)) {
        $emailError = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    }

    // 3. Subject validation (must not be empty)
    if (empty($subject)) {
        $subjectError = "Subject is required.";
    }

    // 4. Message validation (must not be empty)
    if (empty($message)) {
        $messageError = "Message is required.";
    }

    // If no validation errors, proceed with processing the message
    if (empty($nameError) && empty($emailError) && empty($subjectError) && empty($messageError)) {
        // Here you can handle the form data, like sending an email, saving to the database, etc.
        // For now, we'll redirect to a success page or just reload the form.

        // Example of sending an email (commented out):
        // mail($email, $subject, $message);

        echo "<div class='alert alert-success text-center'>Your message has been sent successfully!</div>";
    }
}

?>

<section class="contact-section py-5">
    <div class="container">
        <h1 class="text-center mb-4">Contact Us</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>Send Us a Message</h3>
                <form method="POST" action="">
                    <!-- Full Name field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" 
                               value="<?php echo htmlspecialchars($name); ?>" >
                        <div class="text-danger"><?php echo $nameError; ?></div>
                    </div>

                    <!-- Email Address field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" 
                               value="<?php echo htmlspecialchars($email); ?>" >
                        <div class="text-danger"><?php echo $emailError; ?></div>
                    </div>

                    <!-- Subject field -->
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter the subject" 
                               value="<?php echo htmlspecialchars($subject); ?>" >
                        <div class="text-danger"><?php echo $subjectError; ?></div>
                    </div>

                    <!-- Message field -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" 
                                  placeholder="Write your message here..." ><?php echo htmlspecialchars($message); ?></textarea>
                        <div class="text-danger"><?php echo $messageError; ?></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="col-md-6">
                <h3>Contact Information</h3>
                <ul class="list-unstyled">
                    <li><strong>Phone:</strong> +1 (234) 567-890</li>
                    <li><strong>Email:</strong> info@fashionave.com</li>
                    <li><strong>Address:</strong> 123 Fashion St, Hamilton, Ontario, Canada</li>
                </ul>

                <!-- Google Map -->
                <h3 class="mt-4">Our Location</h3>
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509746!2d-123.36564408468138!3d45.42152927910077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5495b30e7c4a26af%3A0x9e4f84a2b2e9f2e6!2s123%20Fashion%20St%2C%20Hamilton%2C%20ON%20L8N%205G5%2C%20Canada!5e0!3m2!1sen!2sus!4v1622096119641!5m2!1sen!2sus"
                        width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>
