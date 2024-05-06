<?php
// Your database connection code here
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'acc_road_care';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id']) ) {
    $UserId = $_GET['id'];
  

    

    // Perform the database update here
    $update_query = "UPDATE hospital_info SET hospital_enquery = 1 WHERE id = $UserId";
    
    // ... (Your existing database connection code)
    
    
    if ($conn->query($update_query) === TRUE) {
        echo "<script type='text/javascript'>alert('Sent Enquery');window.location.href='patientrequest.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error In adding Enquery');window.location.href='patientrequest.php';</script>";
    }

    // ... (Close the database connection)
    $conn->close();
} else {
    echo "Invalid parameters";
}
?>