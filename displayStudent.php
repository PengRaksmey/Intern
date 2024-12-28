<?php
// filepath: /C:/xampp/htdocs/internProject/Project/intern/displayStudent.php
include "database.php";

// Select data from the student, staff, and school tables
$sql = "SELECT student.studentid, student.name AS stuname, student.age, student.gender, 
               staff.stufname AS teacher_name, school.schname AS school_name
        FROM student
        JOIN staff ON student.teacherid = staff.stufid
        JOIN school ON staff.schlid = school.schoolid";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Students</title>
    <link rel="stylesheet" href="style6.css">
</head>
<body>
    <h2>Display Students</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
        <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Teacher Name</th>
        <th>School Name</th>
        </tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . htmlspecialchars($row["studentid"]). "</td>
            <td>" . htmlspecialchars($row["stuname"]). "</td>
            <td>" . htmlspecialchars($row["age"]). "</td>
            <td>" . htmlspecialchars($row["gender"]). "</td>
            <td>" . htmlspecialchars($row["teacher_name"]). "</td>
            <td>" . htmlspecialchars($row["school_name"]). "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    <div class="button-link" style="margin-top: 10px ; display: inline;" >
    <li>
    <a href="staff.php">Go to staff </a>
    </li>
    <li>
    <a href="student.php">Go to student </a>
    </li>
   <li>
   <a href="dashboard.php">Go to Dashboard</a>
   
   </li>
    </div> 
  
</body>
</html>