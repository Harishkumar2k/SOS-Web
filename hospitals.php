

<?php
session_start();

// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'acc_road_care';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_SESSION['current_location_id'];
// $id = 3;
$sql = "SELECT * FROM signup where id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $locations = array();
    while ($row = $result->fetch_assoc()) {
        $locations[] = array(
            'address' => $row['address'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
        );
    }
    echo json_encode($locations);
   
} else {
    echo json_encode(array());
}

$conn->close();
?>



