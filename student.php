<?php
include "database.php"; 

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

$sql = "SELECT stufid, stufname FROM staff";
$info = $conn->query($sql);

// if (!$info) {
//     die("Error fetching teachers: " . $conn->error);
// }
// $conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style3.css">
</head>

<body>
    <form action="student.php" method="post">
        <div class="text-field">
            <?php 
                if (isset($_POST['submit'])) {
                    $student_name = $_POST['student-name']; 
                    $student_age = (int)$_POST['student-age'];
                    $gender = $_POST['gender'];
                    $teacher = $_POST['teacher-id'];
                    $sql = "INSERT INTO student (name, age, gender, teacherid)
                    VALUES ('$student_name', $student_age, '$gender', '$teacher')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Added successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            ?>
            <label for="student-name">Student Name</label>
            <input type="text" name="student-name" id="student-name" required>
            <label for="student-age">Student Age</label>
            <input type="number" name="student-age" id="student-age" required>
            <div class="button">
                <label for="gender">Male</label>
                <input type="radio" name="gender" id="gender-male" value="male" required>
                <label for="gender">Female</label>
                <input type="radio" name="gender" id="gender-female" value="female" required><br>
                <!-- <label for="teacher-id"> Teacher</label> -->
                <select name="teacher-id" id="teacher-id" required>
                    <option value="">Select teacher</option>
                    <?php while ($row = $info->fetch_assoc()) { ?>
                    <option value="<?php echo htmlspecialchars($row['stufid']); ?>">
                        <?php echo htmlspecialchars($row['stufname']); ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <input type="submit" name="submit" class="" value="Add">
        </div>
    </form>
    <a href="index.php">Go to School section</a>
    <a href="staff.php">Go to staff section</a>
</body>

</html>

<?php
$conn->close();
?>