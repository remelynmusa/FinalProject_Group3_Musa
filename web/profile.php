<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/profile.css">
	<title>Profile</title>
</head>
<style>

</style>
<body>
	<header>
		<img src="img/PLMUN Logo.jpg" alt="Plmun logo" class="logo" style="width:170px;
		height:50px;">
		  <div class="navigation">
			<a href="home.php">Home</a>
			<a href="sched.php">Schedules</a>
			<a href="list.php">Students</a>
			<a href="profile.php">Profile</a>
      </div>
	</header>
	<section>
		<div class="profile-box">
			<?php
        	$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
       		if(mysqli_num_rows($select) > 0){
            	$fetch = mysqli_fetch_assoc($select);
        	}
			?>
            <img class="profile-img" src="uploaded_img/<?php echo $fetch['image'];?>" >;
      		<h3><?php echo $fetch['name'];?></h3>
			<h3><?php echo $fetch['number'];?></h3>
			<a href="logout.php">Logout</a>
		</div>
	</section>
</body>
</html>