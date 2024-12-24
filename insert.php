<?php 
include "database.php";
if (isset($_POST['submit'])){
    $school_name = $_POST['school-name'];
    $school_location = $_POST['school-location'];
    $sql = "INSERT INTO `school`(`schname`,`location`) VALUE ('$school_name','$$school_location')";
    $result = $conn -> query($sql);
    if ($result == true){
        echo "Added";
    } else {
        echo "Error ".$sql."<br>". $conn->error;
    }
    $conn->close();
}


?>