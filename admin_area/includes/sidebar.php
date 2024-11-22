<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height: 100vh;">
    <a href="dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">Admin Menu</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <!-- Dashboard Link -->
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link link-dark">
                Dashboard
            </a>
        </li>
        
        <!-- Customer Link -->
        <li>
            <a href="customer.php" class="nav-link link-dark">
                Customer
            </a>
        </li>

      
        <!-- Manufacturer Section with Toggle -->
        <li>
            <a href="#" class="nav-link link-dark" onclick="toggleSubmenu('manufactureMenu')">
                Manufacturer
            </a>
            <ul class="nav flex-column ms-3" id="manufactureMenu" style="display: none;">
                <li><a href="manufacturer.php" class="nav-link link-dark">Add Manufacturer</a></li>
                <li><a href="view_manufacture.php" class="nav-link link-dark">View Manufacturers</a></li>
            </ul>
        </li>

        <!-- Products Section with Toggle -->
        <li>
            <a href="#" class="nav-link link-dark" onclick="toggleSubmenu('productMenu')">
                Products
            </a>
            <ul class="nav flex-column ms-3" id="productMenu" style="display: none;">
                <li><a href="product.php" class="nav-link link-dark">Add Product</a></li>
                <li><a href="view_product.php" class="nav-link link-dark">View Products</a></li>
            </ul>
        </li>

        <!-- Product Categories Section with Toggle -->
        <li>
            <a href="#" class="nav-link link-dark" onclick="toggleSubmenu('categoryMenu')">
                Product Categories
            </a>
            <ul class="nav flex-column ms-3" id="categoryMenu" style="display: none;">
                <li><a href="product_category.php" class="nav-link link-dark">Add Category</a></li>
                <li><a href="view_categories.php" class="nav-link link-dark">View Categories</a></li>
            </ul>
        </li>

        <!-- Product Subcategories Section with Toggle -->
        <li>
            <a href="#" class="nav-link link-dark" onclick="toggleSubmenu('subcategoryMenu')">
                Product Subcategories
            </a>
            <ul class="nav flex-column ms-3" id="subcategoryMenu" style="display: none;">
                <li><a href="product_subcategory.php" class="nav-link link-dark">Add Subcategory</a></li>
                <li><a href="view_subcategories.php" class="nav-link link-dark">View Subcategories</a></li>
            </ul>
        </li>

        <!-- Logout Link -->
        <li>
            <a href="logout.php" class="nav-link link-warning">
                Logout
            </a>
        </li>
    </ul>
</div>

<script>
    // Toggle function to show/hide submenus
    function toggleSubmenu(menuId) {
        const submenu = document.getElementById(menuId);
        submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
    }
</script>
