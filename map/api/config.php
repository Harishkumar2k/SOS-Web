<?php


session_start();

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
  $Protocol = "https://";
}else{
  $Protocol = "http://";
}

define("SITE_URL",$Protocol.$_SERVER['SERVER_NAME']); 
define("ROOT",$_SERVER['DOCUMENT_ROOT'].""); 
define("UPLOAD_PATH",$_SERVER['DOCUMENT_ROOT']."/login2/uploads"); 
define("UPLOAD_URL",SITE_URL."/login2/uploads/"); 
define("notification_URL",SITE_URL."/login2/notification_img/");


$servername = "localhost";
$username   = "root";
$password   = "";
$db         = "acc_road_care";

// Create connection
$conn =  mysqli_connect($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

?>