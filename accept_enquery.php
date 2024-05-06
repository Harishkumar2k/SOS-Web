<?php 
session_start();
?>
<?php include 'hospital_navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enquiry List</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css'>
  <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
  <style>
    
@media (min-width:720px){
    .attender{
        margin-top: 200px;
    }
}

@media (max-width:720px){
    .attender{
        margin-top: 120px;
    }
}
  </style>
</head>
<body>
  <div class="container attender">
    <div class="col-sm-12">
      <div class="table-responsive">
        <table id="example" class="table table-bordered" style="width: 100%;">
          <thead>
            <tr>
              <th>Reg.No</th>
              <th>Attender Name</th>
              <th>Hospital</th>
              <th>Attender Number</th>
              <th>Patient Name</th>
              <th>Patient Number</th>
              <th>Status</th>
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
        $user = $_SESSION["username"];
   
        // Query to select all images from the table
        $sql = "SELECT * FROM hospital_info WHERE hospital_enquery=1 AND hospitalname = '$user'";

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
            <th>'.$id.'</th>
            <th>'.$username.'</th>
            <th>'.$hospitalname.'</th>
            <th>'.$attendernumber.'</th>
            <th>'.$patientname.'</th>
            <th>'.$patientnumber.'</th>
            <th>
            <a style="text-decoration:none;" href="enquery_accept.php?id='.$id.'">Approve |</a>
            <a style="text-decoration:none;color:red;" href="enquery_reject.php?id='.$id.'">Reject</a>
        </th>
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

  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://cdn.datatables.net/v/dt/dt-1.10.18/sl-1.3.0/datatables.min.js'></script>
  <script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>

  <script>
    $(document).ready(function () {
      var table = $('#example').DataTable({
        'orderCellsTop': true,
        'select': 'api'
      });

      // Handle click event on a checkbox
      $('#example').on('click', 'thead .column-selector th input[type="checkbox"]', function (e) {
        e.stopPropagation();
        var colIdx = $(this).closest('th').index();
        console.log(colIdx);
        if (this.checked) {
          table.column(colIdx).select();
        } else {
          table.column(colIdx).deselect();
        }
      });

      // Handle click event on header cell containing a checkbox
      $('#example').on('click', 'thead .column-selector th', function (e) {
        $('input[type="checkbox"]', this).trigger('click');
      });
    });
  </script>
</body>
</html>
