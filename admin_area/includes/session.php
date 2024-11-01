<?php
session_start();

// Check if the user is an admin, redirect to admin login if not
function checkAdminSession() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: /admin_area/admin_login.php"); // Redirect to admin login
        exit();
    }
}
