<?php

session_start();

include("includes/header.php");

?>


<section class="about-section py-5">
    <div class="container">
        <!-- About the Brand -->
        <h1 class="text-center mb-4">About Us</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                <h3>Our Story</h3>
                <p>
                    Welcome to Avenue Fashion! We are passionate about fashion and dedicated to providing
                    our customers with the latest trends, high-quality apparel, and exceptional customer service. 
                    Our journey started with a vision to bring stylish, affordable, and sustainable fashion 
                    to the market.
                </p>
                <p>
                    Every piece in our collection is carefully curated to ensure it meets our standards of 
                    quality, style, and sustainability. We believe in empowering our customers through fashion, 
                    making them feel confident and unique in every outfit.
                </p>
            </div>
            <div class="col-md-6">
            <img src="images/about.jpg" class="img-fluid rounded" alt="About Us Image" style="width: 400px; height: 400px;">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Values -->
<section class="mission-values-section py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <img src="images/about-mission-icon.png" alt="Mission Icon" class="mb-3" style="width: 60px;">
                <h4>Our Mission</h4>
                <p>
                    Our mission is to inspire confidence and individuality through fashion, providing an inclusive 
                    range of stylish clothing that caters to every customer’s unique taste.
                </p>
            </div>
            <div class="col-md-4">
                <img src="images/value-icon-vector.jpg" alt="Values Icon" class="mb-3" style="width: 60px;">
                <h4>Our Values</h4>
                <p>
                    We value sustainability, quality, and inclusivity. Our collections are designed with the 
                    environment and our customers in mind, ensuring every piece is ethically made and fashion-forward.
                </p>
            </div>
            <div class="col-md-4">
                <img src="images/citizen-icon-12.png" alt="Community Icon" class="mb-3" style="width: 60px;">
                <h4>Community</h4>
                <p>
                    We believe in giving back and supporting the community. A percentage of every purchase goes 
                    towards charitable initiatives and environmental causes.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information Section -->
<section class="contact-info-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Get in Touch</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <p><strong>Phone:</strong> <a href="tel:+1234567890">+1 234 567 890</a></p>
                <p><strong>Email:</strong> <a href="mailto:info@fashionave.com">info@fashionave.com</a></p>
                <p><strong>Address:</strong> 123 Fashion Avenue, Hamilton, On, canada</p>
            </div>
        </div>
    </div>
</section>




<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
