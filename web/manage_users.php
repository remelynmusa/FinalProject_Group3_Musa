<?php
include 'config.php';
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT role FROM `user_form` WHERE id = '$user_id'") or die('Query Failed');
$user = mysqli_fetch_assoc($query);

if ($user['role'] !== 'admin') {
    header('location:home.php');
    exit;
}

// Handle delete user
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `user_form` WHERE id = '$delete_id'") or die('Query Failed');
    header('location:manage_users.php');
    exit;
}

// Fetch all users excluding the current admin
$result = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id != '$user_id'") or die('Query Failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Manage Users</title>
</head>
<body>
    <header>
        <img src="img/PLMUN Logo.jpg" alt="PLMUN Logo" class="logo" style="width:170px; height:50px;">
        <div class="navigation">
            <a href="admin_dashboard.php">Admin Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>
    <section>
        <h1 style="color: white;">Manage Users</h1>
        <form method="POST" style ="width: 80%; margin: 0 auto; border-collapse: collapse;">
        <input type="text" name="number" placeholder="Number" required>
		<input type="text" name="name" placeholder="Name" required>
        <input type="text" name="email" placeholder="Email" required>
        <input type="text" name="password" placeholder="Password" required>
		<input type="text" name="role" placeholder="Role" required>
		<button type="submit" name="add" style="background-color: #11325F; color: #fff; padding: 5px 5px; border: none; border-radius: 3px; cursor: pointer; transition: background-color 0.3s;">Add Student</button>
	</form>
        <table>
            <tr>
                <th>ID</th>
                <th>Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['number']?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['password']?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <a href="edit_student.php?id=<?php echo $user['id']; ?>" class="btn edit-btn">Edit</a>
                        <a href="manage_users.php?delete=<?php echo $user['id']; ?>" class="btn delete-btn" 
                           onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>
</body>
</html>
