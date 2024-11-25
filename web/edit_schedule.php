<?php
include 'config.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location:login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM `schedules` WHERE id = $id") or die('Query Failed');
    $schedule = mysqli_fetch_assoc($result);

    if (!$schedule) {
        echo "Schedule not found.";
        exit;
    }
}

if (isset($_POST['update'])) {
    $section = $_POST['section'];
    $subject = $_POST['subject'];
    $day = $_POST['day'];
    $time = $_POST['time'];
    $professor = $_POST['professor'];
    $room = $_POST['room'];

    mysqli_query($conn, "UPDATE `schedules` SET section = '$section', subject = '$subject', day = '$day', time = '$time',  professor = '$professor', room = '$room' WHERE id = $id") or die('Query Failed');
    header('location:admin_schedule.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Edit Schedule</title>
    <style>
   /* General styling */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: #333;
        }

        /* Header */
        header {
            position: relative;
            top: 0;
            width: 100%;
            padding: 20px 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #11325F;
        }

        header .logo {
            width: 75px;
            height: 20px;
        }

        /* Form Styling */
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: 30px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form h2 {
            text-align: center;
            color: #11325F;
            font-weight: 600;
            margin-bottom: 20px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
        }

        form select {
            background-color: #f7f7f7;
        }

        form button[type="submit"] {
            background-color: #11325F;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }

        form button[type="submit"]:hover {
            background-color: #0d2b46;
        }

        form label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        form .form-group {
            margin-bottom: 15px;
        }

        /* Buttons in header */
        header .navigation a {
            font-size: 20px;
            color: white;
            background: #11325F;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 30px;
            transition: 0.3s;
        }

        header .navigation a:hover {
            background-color: #ffffff86;
        }

        /* Footer */
        footer {
            background-color: #11325F;
            padding: 20px;
            color: white;
            text-align: center;
        }

        /* Media Queries */
        @media (max-width: 960px) {
            header .navigation {
                display: none;
            }

            #check:checked ~ header .navigation {
                display: block;
            }

            label {
                display: block;
                font-size: 25px;
                cursor: pointer;
                transition: 0.3s;
            }
        }
    </style>
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
        <div class="form-container">
            <h1>Edit Schedule</h1>
            <form method="POST">
                <input type="text" name="section" value="<?php echo $schedule['section']; ?>" required placeholder="Section">
                <input type="text" name="subject" value="<?php echo $schedule['subject']; ?>" required placeholder="Subject">
                <input type="text" name="day" value="<?php echo $schedule['day']; ?>" required placeholder="Day">
                <input type="text" name="time" value="<?php echo $schedule['time']; ?>" required placeholder="Time">
                <input type="text" name="room" value="<?php echo $schedule['room']; ?>" required placeholder="Room">
                <input type="text" name="professor" value="<?php echo $schedule['professor']; ?>" required placeholder="Professor">
                <button type="submit" name="update">Update</button>
            </form>
        </div>
    </section>
</body>
</html>
