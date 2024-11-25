<?php
include 'config.php';
session_start();

// Check admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location:login.php');
    exit;
}

// Add new schedule
if (isset($_POST['add'])) {
    $section = $_POST['section'];
    $subject = $_POST['subject'];
    $day = $_POST['day'];
    $time = $_POST['time'];
    $professor = $_POST['professor'];
    $room = $_POST['room'];

    mysqli_query($conn, "INSERT INTO `schedules` (section, subject, day, time, room, professor) VALUES ('$section','$subject', '$day', '$time', '$room', '$professor')") or die('Query Failed');
    header('location:admin_schedule.php');
}

// Delete schedule
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `schedules` WHERE id = $id") or die('Query Failed');
    header('location:admin_schedule.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/admin.css">
	<title>Manage Schedules</title>
</head>
<body>
<header>
        <img src="img/PLMUN Logo.jpg" alt="PLMUN Logo" class="logo" style="width:170px; height:50px;">
        <div class="navigation">
            <a href="admin_dashboard.php">Admin Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>
	<h1>Manage Schedules</h1>
	<form method="POST" style ="width: 80%; margin: 0 auto; border-collapse: collapse;">
		<input type="text" name="section" placeholder="Section" required>
        <input type="text" name="subject" placeholder="Subject" required>
		<input type="text" name="day" placeholder="Day (e.g., MTH)" required>
		<input type="text" name="time" placeholder="Time (e.g., 07:00AM - 08:30AM)" required>
		<input type="text" name="room" placeholder="Room" required>
        <input type="text" name="professor" placeholder="Professor" required>
		<button type="submit" name="add" style="background-color: #11325F; color: #fff; padding: 5px 5px; border: none; border-radius: 3px; cursor: pointer; transition: background-color 0.3s;">Add Schedule</button>
	</form>
	<table>
    <tr>
        <th>Section</th>
        <th>Subject</th>
        <th>Day</th>
        <th>Time</th>
        <th>Room</th>
        <th>Professor</th>
        <th>Action</th>
    </tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM `schedules`") or die('Query Failed');
    while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['section']; ?></td>
        <td><?php echo $row['subject']; ?></td>
        <td><?php echo $row['day']; ?></td>
        <td><?php echo $row['time']; ?></td>
        <td><?php echo $row['professor']; ?></td>  
        <td><?php echo $row['room']; ?></td>
        <td>
            <a href="edit_schedule.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a href="admin_schedule.php?delete=<?php echo $row['id']; ?>"  class="btn delete-btn" 
            onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
    </table>

</body>
</html>
