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
    // Get values from the form
    $academic_year = $_POST['academic_year'];
    $semester = $_POST['semester'];
    $block = $_POST['block'];
    $course_name = $_POST['course_name'];
    $professor = $_POST['professor'];

    // Prepared statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO `courses_taken` (academic_year, semester, block, course_name, professor) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $academic_year, $semester, $block, $course_name, $professor);

    if ($stmt->execute()) {
        header('Location: manage_courses.php');
        exit;
    } else {
        echo 'Error: ' . $stmt->error;
    }
}

// Delete schedule
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Prepare delete query
    $stmt = $conn->prepare("DELETE FROM `courses_taken` WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: manage_courses.php');
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
    <link rel="stylesheet" href="css/admin.css">
    <title>Manage Courses Taken</title>
</head>
<body>
    <header>
        <img src="img/PLMUN Logo.jpg" alt="PLMUN Logo" class="logo" style="width:170px; height:50px;">
        <div class="navigation">
            <a href="admin_dashboard.php">Admin Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>
    <h1>Manage Courses Taken</h1>
    <form method="POST" style="width: 80%; margin: 0 auto; border-collapse: collapse;">
        <input type="text" name="academic_year" placeholder="Academic Year" required>
        <input type="text" name="semester" placeholder="Semester" required>
        <input type="text" name="block" placeholder="Block" required>
        <input type="text" name="course_name" placeholder="Course" required>
        <input type="text" name="professor" placeholder="Professor" required>
        <button type="submit" name="add" style="background-color: #11325F; color: #fff; padding: 5px 5px; border: none; border-radius: 3px; cursor: pointer; transition: background-color 0.3s;">
            Add Schedule
        </button>
    </form>

    <table>
        <tr>
            <th>Academic Year</th>
            <th>Semester</th>
            <th>Block</th>
            <th>Course</th>
            <th>Professor</th>
            <th>Actions</th>
        </tr>
        <?php
        // Fetch courses from database
        $result = mysqli_query($conn, "SELECT * FROM `courses_taken`") or die('Query Failed');
        while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['academic_year']); ?></td>
                <td><?php echo htmlspecialchars($row['semester']); ?></td>
                <td><?php echo htmlspecialchars($row['block']); ?></td>
                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                <td><?php echo htmlspecialchars($row['professor']); ?></td>
                <td>
                    <a href="edit_courses.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="manage_courses.php?delete=<?php echo $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
