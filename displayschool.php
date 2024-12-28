<?php
include "database.php";

// Select data from the school table
$sql = "SELECT 
            school.schoolid, 
            school.schname AS school_name, 
            school.location
        FROM 
            school";

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
    <title>Display Schools</title>
    <link rel="stylesheet" href="style6.css">
</head>
<body>
    <h2>School Schools</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
        <tr> 
            <th>School ID</th>
            <th>School Name</th>
            <th>Location</th>
        </tr>";
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($row["schoolid"]) . "</td>
                <td>" . htmlspecialchars($row["school_name"]) . "</td>
                <td>" . htmlspecialchars($row["location"]) . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
    $conn->close();
    ?>
    <div class="button-link" style="margin-top: 10px; display: inline;">
        <li><a href="staff.php">Go to Staff</a></li>
        <li><a href="student.php">Go to Student</a></li>
        <li><a href="dashboard.php">Go to Dashboard</a></li>
    </div>
</body>
</html>
