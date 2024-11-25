<?php
include 'config.php';
session_start();

// Fetch schedule data
$result = mysqli_query($conn, "SELECT * FROM `schedules`") or die('Query Failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/sched.css">
	<title>Schedules</title>
</head>
<style>
section h1 {
    color: white;
    font-size: 30px;
    padding: 20px;
}

table, td {
  background-color: rgb(17, 50, 95, 0.5);
  text-align: center;
}

th {
  background-color: rgba(255, 255, 255, 0.7);
  text-align: center;
  font-size: 20px;
}

table {
  border-collapse: collapse;
  width: 80%;
  margin: 0 auto;
}

td {
  height: 50px;
  vertical-align: bottom;
  color: white;
  padding-left: 20px;
}
</style>
<body>
	<header>
		<img src="img/PLMUN Logo.jpg" alt="Plmun logo" class="logo" style="width:170px; height:50px;">
		<div class="navigation">
		  <a href="home.php">Home</a>
		  <a href="sched.php">Schedules</a>
		  <a href="list.php">Students</a>
		  <a href="profile.php">Profile</a>
		</div>
	</header>
	<section>
		<h1 style="text-align: center; color: aliceblue; position: relative; top: 20px;">CURRENT SCHEDULES</h1>
		<table>
			<tr>
				<th>Section</th>
				<th>Subject</th>
				<th>Day</th>
				<th>Time</th>
				<th>Professor</th>
				<th>Room</th>
			</tr>
			<?php while ($row = mysqli_fetch_assoc($result)): ?>
			<tr>
				<td><?php echo $row['section']; ?></td>
				<td><?php echo $row['subject']; ?></td>
				<td><?php echo $row['day']; ?></td>
				<td><?php echo $row['time']; ?></td>
				<td><?php echo $row['professor']; ?></td>
				<td><?php echo $row['room']; ?></td>
			</tr>
			<?php endwhile; ?>
		</table>
	</section>
</body>
</html>
