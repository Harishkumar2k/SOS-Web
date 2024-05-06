<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheet.css">
    <!-- <link rel="stylesheet" href="notificationg.css" />
    <link rel="stylesheet" href="notifications.css" /> -->
    <style>
      .frame .group {
  margin-bottom:-400px; /* Adjust this value to control the space between blocks */
}
body{
        overflow-x:hidden;
      }
    </style>
</head>
<body >
<?php include("header.php"); ?>
    <div class="frame"  >
        <div class="container" >
            <div class="overlap text-center mt-3">
                <div class="overlap-group logo-text">
                    
                    <p class="ACC-ROAD-CARE his acc-sos mb-0"> <img class="screenshot" src="https://c.animaapp.com/oGjPm7A1/img/screenshot-2023-08-29-112643-2@2x.png" width="100" />ACCIDENT <span class="span">SOS</span></p>

                </div>
                <!-- <p class="ACC-ROAD-CARE"><span class="text-wrapper">ACC </span> <span class="span">ROAD CARE +</span></p> -->

            </div>
            <hr class="mt-0">
            <div class="text-wrapper-2 fs-35 fw-bold mb-3">Notification</div>

            <div class="rectangle"></div>
            <div class="group-wrapper hor-scroll">
                <!-- First Set of Content -->
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

        // Query to select all images from the table
        $sql = "SELECT * FROM signup WHERE alert = 1 ORDER BY acc_date DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Retrieve the image data
                $id = $row['id'];
                $name = $row['name'];
                $address = $row['address'];
                $vehicle = $row['vehicle'];
                $requestaccepted = $row['requestaccepted'];

                // Generate the HTML for each image with Bootstrap card styling
        
                // echo '<img src="data:image/jpeg;base64,' . base64_encode($image_data) . '" alt="Image"/>';

                echo '<div class="group bg-grey h-200 mb-3">';
                echo '<div class="overlap-group-wrapper">';
                echo '<div class="overlap-group-2">';
                echo '<p class="p acc-sos"><img class="screenshot" src="https://c.animaapp.com/oGjPm7A1/img/screenshot-2023-08-29-112643-2@2x.png" width="50" /> ACCIDENT </span> <span class="span">SOS</span></p>';
                echo '<div class="overlap-2">';
                echo '<p class="hash-mount-road-LIC">';
                echo '   <b class="fs-18">'.$name.'</b><br/>'.$address.'<br/>'.$vehicle.'
                                </p>';
               
                echo '</div>';
                echo '<div class="notification"></div>';
                
                if ($requestaccepted == 1) {
                    echo '<p class="emer"><img class="correct" src="https://c.animaapp.com/oGjPm7A1/img/icons8-correct-100-1-1@2x.png" width="50" /></p>';
                } else {
                    echo '<a href="track.php?id='.$id.'" class="emer"><img class="emergency" src="https://c.animaapp.com/oGjPm7A1/img/icons8-emergency-50-1@2x.png" width="50" /></a>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
           
        } else {
            echo 'No details found in the table.';
        }

        $conn->close();
        ?>
   

                
               
            </div>
        </div>
    
</body>
</html>