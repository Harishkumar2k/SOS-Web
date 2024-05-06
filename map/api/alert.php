<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

include 'config.php';

$RequestMethod = $_SERVER["REQUEST_METHOD"];

// USE THIS WHEN YOU ARE USING INPUT method
$requestData = json_decode(file_get_contents('php://input'), true);

if($RequestMethod == "POST"){
try {

    // REQUEST METHOD FOR API POSTMAN
    $id	        = addslashes((trim($_REQUEST['id'])));
    $address	= addslashes((trim($_REQUEST['address'])));
    $latitude	= addslashes((trim($_REQUEST['latitude'])));
    $longitude	= addslashes((trim($_REQUEST['longitude'])));
    $vehicle	= addslashes((trim($_REQUEST['vehicle'])));

    // Update payment status in the database
    $sql = "UPDATE signup SET vehicle='$vehicle', latitude='$latitude', longitude='$longitude', address='$address', alert=1 WHERE id='$id'";

    if ($conn->query($sql)) {
        // Check if any rows were affected
        if ($conn->affected_rows > 0) {
            // Feedback request successful
            $response = [
                'status' => 200,
                'message' => 'Request Feedback successful'
            ];
            http_response_code(200);
            echo json_encode($response);
        } else {
            // No rows were affected, i.e., no feedback found for the given ID
            $response = [
                'status' => 404,
                'message' => 'No feedback found for the provided ID'
            ];
            http_response_code(404);
            echo json_encode($response);
        }
    } else {
        throw new Exception("Error Request Feedback " . $conn->error);
    }
} catch (Exception $e) {
    $response = [
        'status' => 500,
        'message' => $e->getMessage()
    ];
    http_response_code(500);
    echo json_encode($response);
}}
else{
    $Data = [
        'status' => 405,
        'message' => $RequestMethod . ' Method Not Allowed'
    ];

    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($Data);
}

?>
