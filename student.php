<?php 
include "database.php";

// Fetch school data
$sql1 = "SELECT schoolid, schname FROM school";
$school_info = $conn->query($sql1);

// Fetch staff data
$sql2 = "SELECT stufid, stufname FROM staff";
$staff_info = $conn->query($sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
<div>
    <h1>Add New Student</h1>
    <form action="" method="post">
        <?php 
        if (isset($_POST['submit'])) {
            // Collect form data
            $stu_name = $_POST['stuname'] ; 
            $address = $_POST['address'] ;
            $stu_gender = $_POST['gender'] ;
            $dateof_birth = $_POST['dateofbirth'] ;
            $placeof_birth = $_POST['placeofbirth'] ;
            $school_id = $_POST['school-id'] ;
            $staff_id = $_POST['staff-id'] ;

            // Check for required fields
            if ($stu_name && $address && $stu_gender && $dateof_birth && $placeof_birth && $school_id && $staff_id) {
                $sql = "INSERT INTO student (stuname, gender, dob, pob, stafid, address) 
                        VALUES ('$stu_name', '$stu_gender', '$dateof_birth', '$placeof_birth', '$staff_id', '$address')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<p >Added successfully</p>";
                } else {
                    echo "<p>Error: " . $conn->error . "</p>";
                }
            } else {
                echo "<p'>All fields are required.</p>";
            }
        }
        ?>

        <!-- Form Fields -->
        <div class="text-field">
            <label for="stuname">Student Name</label>
            <input type="text" name="stuname" id="stuname" required>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" required>

            <label for="dateofbirth">Date of Birth</label>
            <input type="date" name="dateofbirth" id="dateofbirth" required>

            <label for="placeofbirth">Place of Birth</label>
            <input type="text" name="placeofbirth" id="placeofbirth" required>
        </div>
        
        <div class="button">
            <label for="male">Male</label>
            <input type="radio" name="gender" id="male" value="male" required>

            <label for="female">Female</label>
            <input type="radio" name="gender" id="female" value="female" required><br>

            <label for="school-id">School</label>
            <select name="school-id" id="school-id" required>
                <option value="">Select School...</option>
                <?php 
                while ($row = $school_info->fetch_assoc()) { 
                    echo "<option value='" . htmlspecialchars($row['schoolid']) . "'>" . htmlspecialchars($row['schname']) . "</option>";
                }
                ?>
            </select><br>

            <label for="staff-id">Staff</label>
            <select name="staff-id" id="staff-id" required>
                <option value="">Select Staff...</option>
                <?php 
                while ($row = $staff_info->fetch_assoc()) { 
                    echo "<option value='" . htmlspecialchars($row['stufid']) . "'>" . htmlspecialchars($row['stufname']) . "</option>";
                }
                ?>
            </select>
        </div>
        
        <input type="submit" name="submit" value="Add">
    </form>
</div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
