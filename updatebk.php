<?php
session_start();

// update.php

// Database connection (same as before)
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'acc_road_care';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id = $_SESSION["id"];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $mobilenumber = $_POST['mobilenumber'];
    $bloodgroup = $_POST['bloodgroup'];
    $gender = $_POST['gender'];

    // Update user details in the database
    $sql = "UPDATE signup SET name='$name', email='$email', age='$age', mobilenumber='$mobilenumber',bloodgroup='$bloodgroup', gender='$gender' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 'User details updated successfully.';
        echo "<script type='text/javascript'>alert('Profile Updated Successfully');window.location.href='home1.php';</script>";
 
    } else {
        echo 'Error updating user details: ' . $conn->error;
    }
}

$conn->close();
?>