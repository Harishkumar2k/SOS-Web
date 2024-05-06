<?php include("header.php"); ?>
<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheet.css">
    <!-- <link rel="stylesheet" href="accinfoperg.css" />
    <link rel="stylesheet" href="accinfopers.css" /> -->
  </head>
  <body>
    <div class="frame">
      <div class="container">
      <div class="overlap text-center mt-3">
                <div class="overlap-group logo-text">
                    
                    <p class="ACC-ROAD-CARE his acc-sos mb-0"> <img class="screenshot" src="https://c.animaapp.com/oGjPm7A1/img/screenshot-2023-08-29-112643-2@2x.png" width="100" />ACCIDENT <span class="span">SOS</span></p>

                </div>

            </div>
            <hr class="mt-0">

          <div class="group bg-grey mb-3 h-320">

            
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

// Check if the user ID is provided in the query parameter

$helpid = $_SESSION["helpid"];
    // Query to fetch user details by ID
    $sql = "SELECT * FROM signup WHERE id = $helpid";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $age = $row['age'];
        $address = $row['address'];
        $id=$row['id'];
        $blood = $row['bloodgroup'];
        $number= $row['mobilenumber'];

       
        echo '<p class="information-of-the">
        <h5>Information of the accident person:</h5>Name&nbsp;&nbsp;: '.$name.'<br />age: '.$age.'<br />D.O.B: 12/3/92<br />Blood
        grp: '.$blood.'<br />Contact: '.$number.'<br />Accident place: '.$address.'<br />
        chennai <br />Date: 8/8/2023<br />Timing : 9:45 am
      </p>';
         // Display a form for editing user details
        //  echo '<a class="emer accid" href="hospitalinfo.php">
        //  <img class="gps" src="https://c.animaapp.com/kUAUMr2T/img/icons8-gps-50-1@2x.png" /></div>
        //  </a>';
    } else {
        echo 'User not found.';
    }


$conn->close();
?>

         
        </div>
       
    </div>
  </body>
</html>
