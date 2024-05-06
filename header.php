<style>
  .notification-count {
    position: absolute;
    /* top: -5px; Adjust as needed to align vertically */
    right: -10px; /* Adjust as needed to align horizontally */
    background-color: red; /* Background color of the notification count */
    color: white; /* Text color of the notification count */
    font-size: 14px; /* Font size of the notification count */
    width: 20px; /* Width of the notification count */
    height: 20px; /* Height of the notification count */
    border-radius: 50%; /* Make it round */
    text-align: center; /* Center the text horizontally */
    line-height: 20px; /* Center the text vertically */
}

</style>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
  <?php
  $db_host = 'localhost';
  $db_user = 'root';
  $db_pass = '';
  $db_name = 'acc_road_care';
  
  // Create connection
  $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
  
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  // Query to select all images from the table
  $sql = "SELECT COUNT(*) AS count FROM signup WHERE alert = 1 AND requestaccepted=0";
  $result = $conn->query($sql);
  
  // Check if the query was successful
  if ($result) {
      // Fetch the count from the result
      $row = $result->fetch_assoc();
      $count = $row['count'];
  
      // Close the result set
      $result->close();
  
      // Display the count in the anchor tag
      echo '<a class="navbar-brand" href="notification.php" style="position: relative; display: inline-block;">
              <img src="image/logo img.png" width="70" alt="logo">
              <span class="notification-count">' . $count . '</span>
            </a>';
  } else {
      echo "Error: " . $conn->error;
  }
  
  // Close the database connection
  $conn->close();
  
  ?>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'home1') ? 'active':''; ?>"  href="home1.php" aria-current="page">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'history') ? 'active':''; ?>" href="history.php">History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'myfriends') ? 'active':''; ?>" href="myfriends.php">Friends</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'hospitalinfo') ? 'active':''; ?>" href="hospitalinfo.php">Hospital Info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'feedback1') ? 'active':''; ?>" href="feedback1.php">Feedback</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'profile') ? 'active':''; ?>" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.html">Logout</a>
        </li>
       
      </ul>

    </div>
  </div>
</nav>
