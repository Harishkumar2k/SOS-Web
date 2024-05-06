<?php $activePage = basename($_SERVER['PHP_SELF'], ".php");?>

<?php include("header.php"); ?>
<?php
session_start();
?>
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
                
$id = $_SESSION["id"];
                // Query to select all images from the table
                $sql = "SELECT * FROM signup where id='$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Retrieve the image data
                        $name = $row['name'];
                        $email = $row['email'];
                        $age = $row['age'];
                        $mobilenumber = $row['mobilenumber'];
                        $bloodgroup = $row['bloodgroup'];
                        $gender = $row['gender'];

                        // Generate the HTML for each image with Bootstrap card styling

                      
                   
                    }
                } else {
                    echo $id;
                    echo 'No images found in the table.';
                }

                $conn->close();
                ?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit Profile </title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheet.css">
    <!-- <link rel="stylesheet" href="profilestyle.css"> -->
    <style>
     
    </style>
   </head>
<body>
  <div class="wrapper" style="align-item:center; justify-content:center; text-align:center;">
  <p class="ACC-ROAD-CARE" style="font-size:40px; text-align:center; margin-top: 40px; margin-bottom: 0;"><span class="span" style="font-weight:bold;" >ACCIDENT </span> <span style="font-weight:bold; color:red;" class="text-wrapper-2">SOS  </span></p>

<img src="image/logo img.png" alt="" style="text-align:center; width:150px;">

    <form action="updatebk.php" method="post" class="hospital-info">
      <div class="input-box mb-4">
        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Username" required>
      </div>
      <div class="input-box mb-4">
        <input type="text" class="form-control" name="gender" placeholder="Gender" value="<?php echo $gender; ?>" required>
      </div>
      <div class="input-box mb-4">
        <input type="text" class="form-control" name="mobilenumber" placeholder="Mobile Number" value="<?php echo $mobilenumber; ?>" required>
      </div>
      <div class="input-box mb-4">
        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
      </div>
      <div class="input-box mb-4">
        <input type="text" class="form-control" name="age" placeholder="Age" value="<?php echo $age; ?>" required>
      </div>
      <div class="input-box mb-4">
        <input type="text" class="form-control" name="bloodgroup" placeholder="Bloodgroup" value="<?php echo $bloodgroup; ?>" required>
      </div>
      
     
      <div class="input-box button">
        <input type="Submit" value="Update" class="submit-btn">
      </div>
     
    </form>
  </div>
</body>
</html>