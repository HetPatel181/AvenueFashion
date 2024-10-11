<?php

session_start();

include("includes/db.php");
include("includes/header.php");

?>


<section class="hero-section text-center text-light d-flex align-items-center" style="background-image: url('images/photo0.png'); background-size: cover; background-position: center; height: 100vh;">
   
</section>

<section class="product-highlight py-5">
    <div class="container">
        <h2 class="text-center mb-4">Featured Products & Promotions</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <img src="images/product1.jpg" class="card-img-top" alt="Product 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">$49.99</p>
                        <a href="#" class="btn btn-outline-primary">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <img src="images/product2.jpg" class="card-img-top" alt="Product 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">$59.99</p>
                        <a href="#" class="btn btn-outline-primary">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <img src="images/product3.jpg" class="card-img-top" alt="Product 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">$69.99</p>
                        <a href="#" class="btn btn-outline-primary">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include("includes/footer.php");
?>

</body>
</html>
