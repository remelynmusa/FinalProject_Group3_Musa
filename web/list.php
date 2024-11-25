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
	<link rel="stylesheet" href="css/list.css">
		<script src="js/search.js"></script>
	<title>List</title>
</head>
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
		<h2 style="text-align: center; color: aliceblue; text-shadow: 2px 2px #11325F; position: relative; top: 20px;" >BSIT 3G OFFICIAL MASTERLIST OF REGULAR STUDENTS</h2>
		<div class="search-box">
            <input type="text" name="" id="find" placeholder="Search here...." onkeyup="search()" >
        </div>
    </nav> 
    <div class="container-fluid">
		<div class="container">
		<div class="product-list">
		<?php 
		$rows = mysqli_query($conn, "SELECT * FROM `user_form` WHERE role != 'admin' ORDER BY id DESC"); 
		?>
		<?php foreach ($rows as $row): ?>
			<div class="product">
				<img class="list-img" src="uploaded_img/<?php echo $row['image']; ?>" alt="list">
				<h4><?php echo $row['name']; ?></h4>
			</div>
		<?php endforeach; ?>
		</div>

		</div>
	</div>
	</section>
</body>
</html>