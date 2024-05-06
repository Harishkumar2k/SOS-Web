<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'acc_road_care';

    // Create a connection to the database
    $mysqli = new mysqli($hostname, $username, $password, $database);

    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }

    // Get the data from the POST request
    $data = json_decode(file_get_contents('php://input'), true);
    $latitude = $data['latitude'];
    $longitude = $data['longitude'];
    $address = $data['address'];
    $vehicle = $data['vehicle'];

    // Assuming you have a unique identifier (e.g., an ID) to identify the record
    $recordId = $_SESSION['id'];

    // Update the data in the database
    $query = "UPDATE signup SET vehicle=?, latitude=?, longitude=?, address=?, alert=1,requestaccepted=0 WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sddsi", $vehicle, $latitude, $longitude, $address, $recordId);

    if ($stmt->execute()) {
        echo "Data updated successfully.";
    } else {
        echo "Error: Data not updated.";
    }

    $stmt->close();
    $mysqli->close();
}
?>
