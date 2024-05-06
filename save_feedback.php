<?php
session_start();

// Check if the form was submitted
if (isset($_POST['submit_feedback'])) {
    // Retrieve the feedback and comments from the form
    $feedback = "Good";
    $comments = $_POST['comments'];
    // You can also store the user ID if you have a user authentication system
    $user_id = $_SESSION["id"]; // Replace with your session variable
    
    // Database connection
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'acc_road_care';

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (user_id, feedback, comments) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $user_id, $feedback, $comments);

    if ($stmt->execute()) {
        // Feedback saved successfully
        echo "<script type='text/javascript'>alert('Thankyou For Your Feedback!');window.location.href='home1.php';</script>";
    } else {
        // Error handling
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} 
elseif (isset($_POST['feedback'])) {
    // Retrieve the feedback and comments from the form
    $feedback = "Good";
    $comments = $_POST['feedback'];
    // You can also store the user ID if you have a user authentication system
    $user_id = $_SESSION["id"]; // Replace with your session variable
    
    // Database connection
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'acc_road_care';

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (user_id, feedback, comments) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $user_id, $feedback, $comments);

    if ($stmt->execute()) {
        // Feedback saved successfully
        echo "<script type='text/javascript'>alert('Thankyou For Your Feedback!');window.location.href='home1.php';</script>";
    } else {
        // Error handling
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle cases where the form wasn't submitted
    echo "Form not submitted.";
}
?>
