<?php

 // Database connection
 $db_host = 'localhost';
 $db_user = 'root';
 $db_pass = '';
 $db_name = 'acc_road_care';

 $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
 

 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 if(isset($_GET['id'])){
    $id=$_GET['id'];


 // Query to select all images from the table
 $sql = "SELECT * FROM signup where id=$id ";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         // Retrieve the image data
         $name = $row['username'];
         $number = $row['mobilenumber'];
         
     
        }
    } else {
        echo 'No data found...';
    }
}
   

   $conn->close();
   ?>
<!DOCTYPE html>
<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheet.css">
    <!-- <link rel="stylesheet" href="ashag.css" />
    <link rel="stylesheet" href="ashas.css" /> -->
  </head>
  <body>
  <?php include("header.php"); ?>
    <div class="frame">
      <div class="div">
      <div class="overlap text-center mt-3">
                <div class="overlap-group logo-text">
                    
                    <p class="ACC-ROAD-CARE his acc-sos mb-0"> <img class="screenshot" src="https://c.animaapp.com/oGjPm7A1/img/screenshot-2023-08-29-112643-2@2x.png" width="100" />ACCIDENT <span class="span">SOS</span></p>

                </div>
                <!-- <p class="ACC-ROAD-CARE"><span class="text-wrapper">ACC </span> <span class="span">ROAD CARE +</span></p> -->

            </div>
            <hr class="mt-0">
        <div class="rectangle" ></div>
        <div class="group-2 text-center">
        <img src="https://c.animaapp.com/Ou5NmDeg/img/image-2@2x.png" width="100" class="my-5">
        <div class="text-wrapper-2 fs-24"><?php echo $name ?></div>
        <div class="text-wrapper-3 fs-24">+91 <?php echo $number ?></div>
        </div>
       
      </div>
    </div>
  </body>
</html>
