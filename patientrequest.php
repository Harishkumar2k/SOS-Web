<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hospital Home</title>
    <link rel="stylesheet" href="hospitalstyle.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css'>
<style>
    body { 
  font-size: 140%; 
}

h2 {
  text-align: center;
  padding: 20px 0;
}

table caption {
	padding: .5em 0;
}

table.dataTable th,
table.dataTable td {
  white-space: nowrap;
}

.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}
</style>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <!-- <i class='bx bxl-c-plus-plus'></i> -->
      <span class="logo_name" style="padding: 10px;">ACCIDENT SOS</span>
    </div>
    <ul class="nav-links">
        <li>
          <a href="hospitalhome.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="patientrequest.php" class="active">
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
        <span class="dashboard">Attender Request</span>
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
        
       
        
     
      <div class="container">
  <div class="row">
    <div class="col-xs-20" >
      <table style="width:1200px;height:500px;" summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
      <br><br><br>
      <thead>
          <tr>
            <th>ID</th>
            <th>Attender Name</th>
            <th>Attender Number</th>
            <th>Hospital</th>
            <th>Patient Name</th>
            <th>Patient Number</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          
          
        

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
        $user_query = "SELECT * FROM signup WHERE id = '$attenderid'";
        $user_result = $conn->query($user_query);

        if ($user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            $username = $user_row['username'];
            $mobilenumber = $user_row['mobilenumber'];
            $bg = $user_row['bloodgroup'];
          
            $pro = "SELECT * FROM signup WHERE id = $patientid ";
            $pro_result = $conn->query($pro);
            if($pro_result->num_rows > 0){
                $pro_row = $pro_result->fetch_assoc();
                $patientname = $pro_row['username'];
                $patientnumber = $pro_row['mobilenumber'];
    
                echo '
                <tr>
            <td>'.$id.'</td>
            <td>'.$username.'</td>
            <td>'.$mobilenumber.'</td>
            <td>'.$hospitalname.'</td>
            <td>'.$patientname.'</td>
            <td>'.$patientnumber.'</td>
            <td><a style="text-decoration:none;" href="hospitalenq.php?id='.$id.'">Send Enquery</a> </td>
          </tr>
               ';
        }}
        } 
      }
        $conn->close();
        ?>
        </tbody>
       
       </table>
     </div>
   </div>
 </div>
 
       
        
         
 
       </div>
     </div>
   </section>
   <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 <script src='https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js'></script>
 <script src='https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js'></script>
 <script src='https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js'>
 <script>
 $('table').DataTable();
 </script>
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

