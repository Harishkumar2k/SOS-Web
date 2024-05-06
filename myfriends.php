<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheet.css">
    
    <title>Category Page </title>

    <style>

        .category-list {
            list-style: none;
            padding: 0;
            text-align: center;
        }
        .category-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .category-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .category-title {
            font-size: 18px;
            font-weight: bold;
        }

    </style>
</head>
<body>
<?php $activePage = basename($_SERVER['PHP_SELF'], ".php");?>
<?php include("header.php"); ?>
<div class="container">
                <div class="text-center my-5">
                    <h1>Followers</h1>
               </div>
              
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
        $sql = "SELECT * FROM signup where usertype=2";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Retrieve the image data
                $username = $row['username'];
                $id = $row['id'];

                // Generate the HTML for each image with Bootstrap card styling
                

                echo ' <div class="card-flex">';
                echo '<ul " class="category-list">';  
                echo '<a href="asha.php?id='.$id.'" style="text-decoration: none;">';
                echo '<li class="category-item">';
                echo '<img src="map_male.png" style="margin-right:300px;" alt="">';       
                echo '<div class="category-title" style="margin-top:-50px; justify-content:center; text-align:center; padding:10px; color: #e51d30;">'.$username.'</div>';
                echo '</li>';
                echo '</a>';
                    
                echo '</ul>';
                echo '</div>';
            
            }
        } else {
            echo 'No images found in the table.';
        }

        $conn->close();
        ?>
  </div>
</body>
</html>