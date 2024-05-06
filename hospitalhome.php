<?php
session_start();

// Database connection settings
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "acc_road_care"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the count of users from the signup table
$sql = "SELECT COUNT(*) AS userCount FROM signup";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    // If there's an error in the query, display an error message and exit
    echo "Error: " . $sql . "<br>" . $conn->error;
    $conn->close();
    exit();
}

// Fetch the result
$row = $result->fetch_assoc();
$userCount = $row["userCount"];

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Hospital Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="hospitalstyle.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <!-- <i class='bx bxl-c-plus-plus'></i> -->
      <span class="logo_name" style="padding: 10px;">ACCIDENT SOS</span>
    </div>
    <ul class="nav-links">
        <li>
          <a href="hospitalhome.php" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="patientrequest.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Attender Request</span>
          </a>
        </li>
        <li>
          <a href="admin_feedback.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Feedback</span>
          </a>
        </li>
        <li>
          <a href="addhospital.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Add Hospital</span>
          </a>
        </li>
      
        <li class="log_out">
          <a href="login.html">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <!-- <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div> -->
      <div class="profile-details">
       <a style="text-decoration:none;" href="login.html">
       <span class="admin_name">Logout</span>
       </a>
      
      </div>
    </nav>
   
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total User</div>
            <div class="number"><?php echo $userCount; ?>000</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bx-user cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Help</div>
            <div class="number">38,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-help-circle cart two'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Life Saved</div>
            <div class="number">12,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bx-plus-medical cart three'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Life Saver</div>
            <div class="number">11,086</div>
            <div class="indicator">
              <i class='bx bx-down-arrow-alt down'></i>
              <span class="text">Down From Today</span>
            </div>
          </div>
          <i class='bx bxs-user-check cart four'></i>
          <!-- <i class='bx bxs-cart-download cart four' ></i> -->
        </div>
      </div>

      <div class="sales-boxes" >
        <div class="recent-sales box" style="text-align:center; justify-content:center;">
          <div class="title">Users</div>
          <div class="sales-details" >
                <ul class="details">
                  <li class="topic">ID</li>
                
                </ul>
                <ul class="details">
                <li class="topic">Name</li>
         
              </ul>
              <ul class="details" style="text-align:center; justify-content:center;">
                <li class="topic">Gender</li>
        
              </ul>
              <ul class="details">
                <li class="topic">Blood Group</li>
             
              </ul>
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
        $sql = "SELECT * FROM signup";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Retrieve the image data
                $id = $row['id'];
                $name = $row['name'];
                $gender = $row['gender'];
                $bloodgroup = $row['bloodgroup'];
          
                echo '
                
                <div class="sales-details">
                <ul class="details">
                  <li><a href="#">'.$id.'</a></li>
                
                </ul>
                <ul class="details">
                <li><a href="#">'.$name.'</a></li>
         
              </ul>
              <ul class="details" style="text-align:center; justify-content:center;">
                <li><a href="#">'.$gender.'</a></li>
        
              </ul>
              <ul class="details">
                <li><a href="#">'.$bloodgroup.'</a></li>
             
              </ul>
              </div>';
           
        } 
      }
        $conn->close();
        ?>
          <!-- <div class="button">
            <a href="#">See All</a>
          </div> -->
        </div>
        <div class="top-sales box">
          <div class="title">Patient Admitted</div>
          <ul class="top-sales-details">

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

$sql = "SELECT * FROM hospital_info";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Retrieve the image data
        $id = $row['id'];
        $hospitalname = $row['hospitalname'];
        $attendername = $row['attendername'];
        $attendernumber = $row['attendernumber'];
        $patientid = $row['patientid'];
        $attenderid = $row['attenderid'];
        

        // Get username from the signup table using user_id
        $user_query = "SELECT * FROM signup WHERE id = '$patientid'";
        $user_result = $conn->query($user_query);

        if ($user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            $username = $user_row['username'];
            $mobilenumber = $user_row['mobilenumber'];
            $bg = $user_row['bloodgroup'];
            
        
        

            // Generate the HTML for each image with Bootstrap card styling
            echo '
            <li>
            <a href="#">
              <span class="product">'.$username.'</span>
            </a>
            <span class="price">'.$bg.'</span>
            </li>
       ';
        }} 
    }
 else {
    echo 'No Data found in the table.';
}

$conn->close();
?>
        

            
          
          </ul>
        </div>

      </div>
    </div>
  </section>

  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

</body>
</html>