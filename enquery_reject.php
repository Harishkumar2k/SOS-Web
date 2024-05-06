<?php

// Database connection
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'acc_road_care';

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user ID is provided in the query parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to update the appointment status
    $sql = "UPDATE hospital_info SET enq_status = 0 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to another page after a successful update
        echo "<script type='text/javascript'>alert('Request Rejected');window.location.href='accept_enquery.php';</script>";
    } else {
        echo 'Error updating appointment: ' . $conn->error;
    }
} else {
    echo 'User ID not provided.';
}

$conn->close();
?>