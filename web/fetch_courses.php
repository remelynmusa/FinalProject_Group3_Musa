<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

$sql = "SELECT * FROM courses_taken";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["academic_year"] . "</td>";
        echo "<td>" . $row["semester"] . "</td>";
        echo "<td>" . $row["block"] . "</td>";
        echo "<td>" . $row["professor"] . "</td>";
        echo "<td>" . $row["course_name"] . "</td>";
        echo "</tr>";
    }
} else {
    echo " ";
}

$conn->close();
?>
