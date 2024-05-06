<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Hospital Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            overflow-x: hidden;
        }

        /* Add custom styles for the custom alert */
        .custom-alert {
            display: none;
            background-color: green;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            z-index: 1000;
            font-size: 18px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .custom-alert i {
            margin-right: 10px;
        }

        a {
            text-decoration: none;
            /* Remove underline on the link */
            color: inherit;
            /* Inherit the color from the parent element */
        }

        a:active {
            color: inherit;
            /* Set the active state color to inherit from the parent element */
        }

        .hospital-info {
            text-align: center;
            padding: 50px 0;
        }

        .hospital-info img {
            width: 1026px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
    <?php include("aboutheader.php"); ?>

    <section class="hospital-info">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex">
                    <img src="hospitalabout.png" alt="Hospital Image">
                </div>
                <div class="col-md-6 text-center align-items-center justify-content center">
                    <h2>About us</h2>
                    <p style="text-align:justify;">Accident SOS is a life-saving application designed to provide immediate assistance to individuals involved in accidents. With just a few taps, users can send alert messages to designated contacts, informing them of their distress and exact location. This innovative solution ensures swift response times, enabling friends, family, and emergency services to promptly reach the scene and provide necessary aid. Through its intuitive interface and robust features, Accident SOS aims to minimize response delays and maximize the chances of survival and recovery for accident victims. 
                    
                    <br><br>Whether it's a minor incident or a critical emergency, this app serves as a reliable companion, offering peace of mind and security to users in times of crisis. With real-time tracking capabilities, it empowers responders to navigate to the precise location of the accident swiftly. By leveraging cutting-edge technology and seamless communication channels, Accident SOS revolutionizes the way we approach emergency situations, fostering a safer and more connected community. In essence, it's more than just an app—it's a lifeline, bridging the gap between distress and assistance, and ultimately saving lives.</p>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
