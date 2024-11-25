<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <title>Home Page</title>
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
  <section>
    <header>
      <img src="img/PLMUN Logo.jpg" alt="Plmun logo" class="logo" style="width:170px;height:50px;">
      <div class="navigation">
        <a href="home.php">Home</a>
        <a href="sched.php">Schedules</a>
        <a href="list.php">Students</a>
        <a href="profile.php">Profile</a>
      </div>
    </header>
    <h1 style="text-align: center; color: aliceblue; position: relative; top: 20px;">COURSES TAKEN</h1>
    <table>
      <tr>
        <th>Academic Year</th>
        <th>Semester</th>
        <th>Block</th>
        <th>Section</th>
        <th>Course</th>
      </tr>
      <?php include 'fetch_courses.php'; ?>
    </table>
    <div class="media-icons" style="position: b;">
      <a href="https://www.facebook.com/pancxzs/"><i class="fa-brands fa-facebook"></i></a>
      <a href="https://x.com/home"><i class="fa-brands fa-twitter"></i></a>
      <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
    </div>
    <footer>BSIT - IT3G ⓒ 2023</footer>
  </section>
</body>

</html>
