<?php

session_start();

include("includes/db.php");
include("includes/header.php");

?>

<section class="checkout-section py-5">
    <div class="container">
        <h1 class="text-center mb-4">Checkout</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>Shipping Information</h3>
                <form>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter your address" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Enter your city" required>
                    </div>
                    <div class="mb-3">
                        <label for="postalCode" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postalCode" placeholder="Enter your postal code" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" required>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Payment Information</h3>
                <form>
                    <div class="mb-3">
                        <label for="cardName" class="form-label">Cardholder Name</label>
                        <input type="text" class="form-control" id="cardName" placeholder="Enter cardholder's name" required>
                    </div>
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" placeholder="Enter card number" required>
                    </div>
                    <div class="mb-3">
                        <label for="expiryDate" class="form-label">Expiry Date</label>
                        <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required>
                    </div>
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" placeholder="Enter CVV" required>
                    </div>
                </form>
            </div>
        </div>

        <div class="summary mt-4">
            <h3>Order Summary</h3>
            <ul class="list-unstyled">
                <li>Product Name 1 - $29.99</li>
                <li>Product Name 2 - $39.99</li>
                <li><strong>Total Amount: $69.98</strong></li>
            </ul>
            <button class="btn btn-success" id="placeOrderButton">Place Order</button>
        </div>
    </div>
</section>

<<?php
include("includes/footer.php");
?>