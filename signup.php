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
    $username = $_POST['username'];

	 $name = $_POST['name'];

     $age = $_POST['age'];
     $dob = $_POST['dob'];

     $gender = $_POST['gender'];
     $bloodgroup = $_POST['bloodgroup'];

     $email = $_POST['email'];

     $mobilenumber = $_POST['mobilenumber'];

     $password = $_POST['password'];

     $confirmpassword = $_POST['confirmpassword'];



     $sql = "INSERT INTO signup (username, name, age,dob, gender,bloodgroup,email, mobilenumber, password, confirmpassword, usertype) VALUES('$username','$name','$age','$dob','$gender','$bloodgroup','$email','$mobilenumber','$password','$confirmpassword',2)";
	 

if ($conn->query($sql) === TRUE) {
  
  echo "<script type='text/javascript'>alert('$message');window.location.href='login.html';</script>";
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
