<?php

session_start();

include("includes/header.php");
?>

<section class="product-section py-5">
    <div class="container">
        <h1 class="text-center mb-4">Our Products</h1>
        <div class="row">
            <!-- Product Item 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/product1.jpg" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Product Name 1</h5>
                        <p class="card-text">This is a short description of product 1. It's stylish and affordable.</p>
                        <p class="price">$29.99</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <!-- Product Item 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/product2.jpg" class="card-img-top" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title">Product Name 2</h5>
                        <p class="card-text">This is a short description of product 2. Perfect for every occasion.</p>
                        <p class="price">$39.99</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <!-- Product Item 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/product3.jpg" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Product Name 3</h5>
                        <p class="card-text">This is a short description of product 3. Trendy and chic!</p>
                        <p class="price">$49.99</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <!-- Add more product items as needed -->
        </div>
    </div>
</section>

<?php

include("includes/footer.php");

?>