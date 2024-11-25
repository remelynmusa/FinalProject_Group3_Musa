<?php

include 'config.php';

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $email = $_POST['email'];
   $num = $_POST['number'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');

   if (mysqli_num_rows($select) > 0) {
      $message[] = 'user already exists';
   } else {
      if ($pass != $cpass) {
         $message[] = 'confirm password does not match!';
      } elseif ($image_size > 2000000) {
         $message[] = 'image size is too large!';
      } else {
         $role = (strpos($email, '.admin') !== false) ? 'admin' : 'user'; // Set role based on email
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, number, password, image, role) VALUES('$name', '$email','$num', '$pass', '$image', '$role')") or die('query failed');

         if ($insert) {
            move_uploaded_file($image_tmp_name, $image_folder);
            header('location:login.php');
         } else {
            echo '<script>alert("Not registered")</script>';
         }
      }
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/reglog.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <title>Register Page</title>
</head>
<body>
  <section>
    <img src="img/PLMUN Logo.jpg" alt="" class="logo" >
  <div class="content">
      <div class="info">
        <h2>This is<br><span>BSIT 3G</span></h2>
        <p>Class Profile of Block 3G under Bachelor of Science in Information Technology<br>Pamantasan ng Lungsod ng Muntinlupa Admission Year 2022-2023</p>
       <a href="moreinfo.html" class="info-btn">More Info</a>
      </div>
      <form class="reg" method="post" action="" enctype="multipart/form-data">
        <h3>Register here!</h3>
        <div class="container">   
        <input type="text" name="name" placeholder="enter username" class="box" required>
         <input type="email" name="email" placeholder="enter email" class="box" required>
         <input type="text" name="number" placeholder="enter student number" class="box" required>
         <input type="password" name="password" placeholder="enter password" class="box" required>
         <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
         <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
         <input type="submit" name="submit" value="register now" class="btn">
        </div>   
    </form>     
</div>
<div class="media-icons">
  <a href="https://www.facebook.com/pancxzs/"><i class="fa-brands fa-facebook"></i></a>
  <a href="#"><i class="fa-brands fa-twitter"></i></a>
  <a href="#"><i class="fa-brands fa-instagram"></i></a>
</div>
<footer>BSIT - IT3G ⓒ 2023</footer>
  </section>
</body>
</html>