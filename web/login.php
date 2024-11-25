  <?php
  include 'config.php';
  session_start();

  if (isset($_POST['submit'])) {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = mysqli_real_escape_string($conn, $_POST['password']);
      
      $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

      if (mysqli_num_rows($select) > 0) {
          $row = mysqli_fetch_assoc($select);
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['role'] = $row['role']; // Store the role in the session

          // Redirect based on role
          if ($row['role'] === 'admin') {
              header('location:admin_dashboard.php');
          } else {
              header('location:home.php');
          }
      } else {
          echo '<script>alert("Invalid email or password!");</script>';
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
    <title>Login Page</title>
  </head>
  <body>
    <section>
      <img src="img/PLMUN Logo.jpg" alt="" class="logo">
    <div class="content">
        <div class="info">
          <h2>This is<br><span>BSIT 3G</span></h2>
          <p>Class Profile of Block 3G under Bachelor of<br>Science in Information Technology<br>Pamantasan ng Lungsod ng Muntinlupa<br>Admission Year 2023-2024</p>
        <a href="moreinfo.html" class="info-btn">More Info</a>
        </div>
        <form class="log" method="post" action="">
          <h3>Login here!</h3>
          <div class="container">   
              <input type="email" name="email" placeholder="enter email" class="box" required>
              <input type="password" name="password" placeholder="enter password" class="box" required>
              <input type="submit" name="submit" value="login now" class="btn">
              <br>  
              <a>Register <a href="register.php"> here! </a>   
          </div>   
      </form>     
  </div>
  <div class="media-icons">
    <a href="https://www.facebook.com/pancxzs/"><i class="fa-brands fa-facebook"></i></a>
    <a href="#"><i class="fa-brands fa-twitter"></i></a>
    <a href="#"><i class="fa-brands fa-instagram"></i></a>
  </div>
  <footer>BSIT - IT3G ⓒ 2024</footer>
    </section>
  </body>
  </html>