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

// Check if the user ID is provided in the query parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $requestuser = $_SESSION["id"];

    try {
        // Begin the transaction
        $conn->begin_transaction();

        // Query to update the first table
        $sql1 = "UPDATE signup SET requestaccepted='1', request_user = $requestuser WHERE id = $id";
        $conn->query($sql1);

        // Query to update the second table
        $sql2 = "UPDATE signup SET attender_id=$id WHERE id = $requestuser";
        $conn->query($sql2);

        // Commit the transaction
        $conn->commit();

        $sql = "SELECT * from signup where id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $_SESSION["helpid"] = $row["id"];

        // Redirect to the desired location
        header("Location: accinfoper.php");
    } catch (Exception $e) {
        // An error occurred, rollback changes
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }
} else {
    echo 'User ID not provided.';
}

$conn->close();
?>
