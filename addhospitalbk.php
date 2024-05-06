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
    

	 $name = $_POST['name'];

     $email = $_POST['email'];

     $password = $_POST['password'];




     $sql = "INSERT INTO signup (username,email,password,usertype) VALUES('$name','$email','$password',3)";
	 

if ($conn->query($sql) === TRUE) {
  
  echo "<script type='text/javascript'>alert('$message');window.location.href='addhospital.php';</script>";
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
