<?php

session_start();

include("includes/db.php");
include("includes/header.php");

?>

<section class="cart-section py-5">
    <div class="container">
        <h1 class="text-center mb-4">Shopping Cart</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="images/product1.jpg" alt="Product 1" class="img-fluid" style="width: 100px;"></td>
                        <td>Product Name 1</td>
                        <td>$29.99</td>
                        <td>
                            <input type="number" class="form-control" value="1" min="1">
                        </td>
                        <td>$29.99</td>
                        <td>
                            <button class="btn btn-danger">Remove</button>
                            <button class="btn btn-primary">Update</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="images/product2.jpg" alt="Product 2" class="img-fluid" style="width: 100px;"></td>
                        <td>Product Name 2</td>
                        <td>$39.99</td>
                        <td>
                            <input type="number" class="form-control" value="1" min="1">
                        </td>
                        <td>$39.99</td>
                        <td>
                            <button class="btn btn-danger">Remove</button>
                            <button class="btn btn-primary">Update</button>
                        </td>
                    </tr>
                    <!-- Add more products as needed -->
                </tbody>
            </table>
        </div>
        
        <div class="summary mt-4">
            <h3>Cart Summary</h3>
            <p><strong>Total Amount:</strong> $69.98</p>
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
        </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>
