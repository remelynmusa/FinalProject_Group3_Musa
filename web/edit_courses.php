<?php
include 'config.php';
session_start();

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location:login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Retrieve the course details using the course ID
    $result = mysqli_query($conn, "SELECT * FROM `courses_taken` WHERE id = $id") or die('Query Failed');
    $course = mysqli_fetch_assoc($result);

    if (!$course) {
        echo "Course not found.";
        exit;
    }
}

if (isset($_POST['update'])) {
    // Get updated values from the form
    $academic_year = $_POST['academic_year'];
    $semester = $_POST['semester'];
    $block = $_POST['block'];
    $course_name = $_POST['course_name'];
    $professor = $_POST['professor'];

    // Update the course in the database
    $stmt = $conn->prepare("UPDATE `courses_taken` SET academic_year = ?, semester = ?, block = ?, course_name = ?, professor = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $academic_year, $semester, $block, $course_name, $professor, $id);

    if ($stmt->execute()) {
        header('location: manage_courses.php');
        exit;
    } else {
        echo 'Error: ' . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edit.css">
    <title>Edit Course</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/PLMUN Logo.jpg" alt="PLMUN Logo" class="logo" style="width:170px; height:50px;">
        </div>
        <div class="navigation">
            <a href="admin_dashboard.php">Admin Dashboard</a>
            <a href="manage_courses.php">Back to Courses</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <section style="">
        <form method="POST">
            <h2>Edit Course</h2>
            <div class="form-group">
                <label for="academic_year">Academic Year:</label>
                <input type="text" name="academic_year" value="<?php echo htmlspecialchars($course['academic_year']); ?>" required>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <input type="text" name="semester" value="<?php echo htmlspecialchars($course['semester']); ?>" required>
            </div>
            <div class="form-group">
                <label for="block">Block:</label>
                <input type="text" name="block" value="<?php echo htmlspecialchars($course['block']); ?>" required>
            </div>
            <div class="form-group">
                <label for="course_name">Course:</label>
                <input type="text" name="course_name" value="<?php echo htmlspecialchars($course['course_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="professor">Professor:</label>
                <input type="text" name="professor" value="<?php echo htmlspecialchars($course['professor']); ?>" required>
            </div>
            <button type="submit" name="update">Update Course</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 PLMUN. All rights reserved.</p>
    </footer>
</body>
</html>
