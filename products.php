<?php
session_start();
include("includes/header.php");
include('includes/db.php'); // Include the database connection

// Fetch products from the database
$sql = "SELECT id, product_name, product_price, product_sale_price, image1 FROM products";
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<section class="product-section py-5">
    <div class="container">
        <h1 class="text-center mb-4">Our Products</h1>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Output each product in a card format
                while ($row = $result->fetch_assoc()) {
                    // Decode the image from LONGBLOB format
                    $imageData = base64_encode($row['image1']);
                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;

                    echo '<div class="col-md-4 mb-4">';
                    echo '  <div class="card">';
                    echo '    <img src="' . $imageSrc . '" class="card-img-top" alt="' . htmlspecialchars($row['product_name']) . '">';
                    echo '    <div class="card-body">';
                    echo '      <h5 class="card-title">' . htmlspecialchars($row['product_name']) . '</h5>';
                    echo '      <p class="price">Price: $' . htmlspecialchars(number_format($row['product_price'], 2)) . '</p>';

                    // Check if sale price is set and display it
                    if ($row['product_sale_price']) {
                        echo '      <p class="sale-price">Sale Price: $' . htmlspecialchars(number_format($row['product_sale_price'], 2)) . '</p>';
                    }

                    echo '      <a href="#" class="btn btn-primary">Add to Cart</a>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12"><p class="text-center">No products found.</p></div>';
            }
            ?>
        </div>
    </div>
</section>

<?php
include("includes/footer.php");
$conn->close(); // Close the database connection
?>
