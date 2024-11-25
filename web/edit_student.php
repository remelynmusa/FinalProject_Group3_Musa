<?php
include 'config.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location:login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = $id") or die('Query Failed');
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "User not found.";
        exit;
    }
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];

    mysqli_query($conn, "UPDATE `user_form` SET name = '$name', email = '$email', password = '$password' , role = '$role' WHERE id = $id") or die('Query Failed');
    header('location:admin_users.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edit.css">
    <title>Edit User</title>
</head>
<body>
    <header>
        <div class="logo">
        <img src="img/PLMUN Logo.jpg" alt="PLMUN Logo" class="logo" style="width:170px; height:50px;">
        </div>
        <div class="navigation">
            <a href="admin_dashboard.php">Admin Dashboard</a>
            <a href="manage_users.php">Back to Users</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <section>
        <form method="POST">
            <h2>Edit User</h2>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Enter new password">
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" required>
                    <option value="User" <?php echo ($user['role'] == 'User') ? 'selected' : ''; ?>>User</option>
                    <option value="Admin" <?php echo ($user['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>
            <a type="submit" href="manage_users.php" name="update">Update User</>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 PLMUN. All rights reserved.</p>
    </footer>
</body>
</html>
