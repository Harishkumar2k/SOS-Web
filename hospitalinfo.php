<?php $activePage = basename($_SERVER['PHP_SELF'], ".php");?>
<?php include("header.php"); ?>
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
        $requestuser = $_SESSION["id"];
        // Query to select all images from the table
        $sql = "SELECT * FROM signup where id=$requestuser";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Retrieve the image data
                $id = $row['id'];
                $name = $row['name'];
                $attender_id = $row['attender_id'];
            }
           
        } else {
            echo 'No images found in the table.';
        }

        $conn->close();
        ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Info</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheet.css">
    <!-- <link rel="stylesheet" href="hospital.css">
    <link rel="stylesheet" href="home1g.css" />
    <link rel="stylesheet" href="home1s.css" /> -->
    <style>

    </style>
   </head>
<body>
  
<div class="bbb" >


  <div class="wrapper" style="align-item:center; justify-content:center; text-align:center;">
  <p class="ACC-ROAD-CARE mt-5 mb-0" style="font-size:40px; text-align:center;"><span class="span" style="font-weight:bold;" >ACCIDENT </span> <span style="font-weight:bold; color:red;" class="text-wrapper-2">SOS  </span></p>

    <img src="image/logo img.png" alt="" style="width:150px;text-align:center;">

    <form action="hospitalinfobk.php" class="hospital-info" method="POST">
      <div class="input-box mb-4">
        <input type="text" name="hospitalname" placeholder="hospitalname" required class="form-control">
      </div>
      <div class="input-box mb-4">
        <input type="text" name="attendername" placeholder="attendername" required class="form-control">
      </div>
      <div class="input-box mb-4">
        <input type="text" name="attendernumber" placeholder="Attendernumber" required class="form-control">
      </div>
      <div class="input-box mb-4">
        <input type="text" name="patientid" value="<?php echo $attender_id; ?>" placeholder="patientid" required class="form-control">
      </div>
      <div class="input-box mb-4">
        <input type="text" name="attenderid" value="<?php echo $id; ?>" placeholder="attenderid" required class="form-control">
      </div>
      <div class="input-box button">
        <input type="Submit" value="Register Now" class="submit-btn">
      </div>
    
    </form>
  </div>
  </div>
</body>
</html>