<?php
// Include database configuration
include 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header('location:login.php'); // Redirect to login if not logged in
    exit;
}

// Verify admin role
if ($_SESSION['role'] !== 'admin') {
    header('location:home.php'); // Redirect to home if not an admin
    exit;
}

// Get user ID from the session
$user_id = $_SESSION['user_id']; // This can be used for further actions on the page
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
        <img src="img/PLMUN Logo.jpg" alt="PLMUN Logo" class="logo" style="width:170px; height:50px;">
        <div class="navigation">
            <a href="manage_users.php">Manage Users</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>
    <section>
        <h1 style="color: white;">Admin Dashboard</h1>
        <div class="admin-actions">
            <a href="manage_users.php" class="btn">Manage Users</a>
            <a href="admin_schedule.php" class="btn">Manage Schedules</a>
            <a href="manage_courses.php" class="btn">Manage Courses Taken</a>
        </div>
    </section>
</body>
</html>
