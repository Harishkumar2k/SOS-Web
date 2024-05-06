<?php

    $servername = "localhost";

    $username = "root";

    $password = "";

    $dbname = "acc_road_care"; 
	
	$message = "Register successful";
	
	
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
     $hospitalname = $_POST['hospitalname'];

	 $attendername = $_POST['attendername'];

     $attendernumber = $_POST['attendernumber'];

     $patientid = $_POST['patientid'];

     $attenderid = $_POST['attenderid'];
     



     $sql = "INSERT INTO hospital_info (hospitalname, attendername, attendernumber, patientid, attenderid) VALUES('$hospitalname','$attendername','$attendernumber','$patientid','$attenderid')";
	 

if ($conn->query($sql) === TRUE) {
  
  echo "<script type='text/javascript'>alert('$message');window.location.href='hospitalinfo.php';</script>";
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
