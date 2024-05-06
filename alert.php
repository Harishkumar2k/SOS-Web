<!DOCTYPE html>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <?php
        // Database connection
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'orphan_care';

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to select all images from the table
        $sql = "SELECT * FROM trustinfo";
        $result = $conn->query($sql);

    <link rel="stylesheet" href="alertg.css" />
    <link rel="stylesheet" href="alerts.css" />
  </head>
  <body>
    <div class="frame">
      <div class="div">
        <div class="overlap">
          <div class="overlap-group">
            <img class="line" src="https://c.animaapp.com/QRnRhUfd/img/line-22.svg" />
            <img class="screenshot" src="https://c.animaapp.com/QRnRhUfd/img/screenshot-2023-08-29-112643-2@2x.png" />
          </div>
          <p class="ACC-ROAD-CARE"><span class="text-wrapper">ACC </span> <span class="span">ROAD CARE +</span></p>
        </div>
        <div class="overlap-2">
          <img class="alarm" src="https://c.animaapp.com/QRnRhUfd/img/alarm-1@2x.png" />
          <div class="text-wrapper-2">Alert has been sent</div>
        </div>
        <div class="rectangle"></div>
      </div>
    </div>
  </body>
</html>
