<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="stylesheet.css">
    <style>
        /* CSS */
        .button-82-pushable {
            position: relative;
            border: none;
            background: transparent;
            padding: 0;
            cursor: pointer;
            outline-offset: 4px;
            transition: filter 250ms;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .button-82-shadow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            background: hsl(0deg 0% 0% / 0.25);
            will-change: transform;
            transform: translateY(2px);
            transition:
                transform 600ms cubic-bezier(.3, .7, .4, 1);
        }

        .button-82-edge {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            background: linear-gradient(to left,
                    hsl(340deg 100% 16%) 0%,
                    hsl(340deg 100% 32%) 8%,
                    hsl(340deg 100% 32%) 92%,
                    hsl(340deg 100% 16%) 100%);
        }

        .button-82-front {
            display: block;
            position: relative;
            padding: 12px 27px;
            border-radius: 12px;
            font-size: 1.1rem;
            color: white;
            background: hsl(345deg 100% 47%);
            will-change: transform;
            transform: translateY(-4px);
            transition:
                transform 600ms cubic-bezier(.3, .7, .4, 1);
        }

        @media (min-width: 768px) {
            .button-82-front {
                font-size: 1.25rem;
                padding: 12px 42px;
            }
        }

        .button-82-pushable:hover {
            filter: brightness(110%);
            -webkit-filter: brightness(110%);
        }

        .button-82-pushable:hover .button-82-front {
            transform: translateY(-6px);
            transition:
                transform 250ms cubic-bezier(.3, .7, .4, 1.5);
        }

        .button-82-pushable:active .button-82-front {
            transform: translateY(-2px);
            transition: transform 34ms;
        }

        .button-82-pushable:hover .button-82-shadow {
            transform: translateY(4px);
            transition:
                transform 250ms cubic-bezier(.3, .7, .4, 1.5);
        }

        .button-82-pushable:active .button-82-shadow {
            transform: translateY(1px);
            transition: transform 34ms;
        }

        .button-82-pushable:focus:not(:focus-visible) {
            outline: none;
        }
    </style>
</head>

<body style="text-align:center;">
    <div id="map" class="map-hgt"></div>
    <p id="location"></p>

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

    // Check if the user ID is provided in the query parameter
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query to fetch user details by ID
        $sql = "SELECT * FROM signup WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $name = $row['address'];
        } else {
            echo 'User not found.';
        }
    } else {
        echo 'User ID not provided.';
    }

    echo '<div style="margin-top:20px;">';

    echo '<center>
    <a  href="accept.php?id=' . $id . '">
    <button class="button-82-pushable" role="button">
    <span class="button-82-shadow"></span>
    <span class="button-82-edge"></span>
    <span class="button-82-front text">
      Accept
    </span>
  </button>
</a>
<br><br>
<a href="home1.php">
<button class="button-82-pushable" role="button">
  <span class="button-82-shadow"></span>
  <span class="button-82-edge"></span>
  <span class="button-82-front text">
    Reject
  </span>
</button>
</a></center>
';
    echo '</div>';
    $conn->close();
    ?>
    <script>
        function getLocationsAndShowMap() {
            fetch('hospitals.php')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        showMapWithLocations(data);
                    } else {
                        alert('No locations found in the database.');
                    }
                })
                .catch(error => {
                    console.log("Error: " + error);
                });
        }

        function showMapWithLocations(locations) {
            // Initialize the map
            var map = L.map('map').setView([locations[0].latitude, locations[0].longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add markers for each location from the database
            locations.forEach(location => {
                L.marker([location.latitude, location.longitude])
                    .addTo(map)
                    .bindPopup(location.address)
                    .openPopup();

                // Find nearby hospitals
                findNearbyHospitals(map, location.latitude, location.longitude);
            });

            // Manually add 5 static hospital locations
            var staticHospitals = [{
                    latitude: 13.0375525,
                    longitude: 80.1446072,
                    address: "Ramachandra Hospital"
                },
                {
                    latitude: 13.0579493,
                    longitude: 80.1273321,
                    address: "ACS Hospital"
                },
                {
                    latitude: 13.0506113,
                    longitude: 80.0986529,
                    address: "Bee Well Hospital"
                },
                {
                    latitude: 13.0275144,
                    longitude: 80.0144812,
                    address: "Saveetha Medical College"
                },
                {
                    latitude: 13.0472609,
                    longitude: 80.074711,
                    address: "Panimalar Medical College"
                }
            ];

            // Define a red marker icon
            var redIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            staticHospitals.forEach(hospital => {
                L.marker([hospital.latitude, hospital.longitude], {
                        icon: redIcon
                    })
                    .addTo(map)
                    .bindPopup(hospital.address)
                    .openPopup();
            });

            // Create a green marker icon
            var greenIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            // Example: Display a green marker at the live location
            navigator.geolocation.getCurrentPosition(position => {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                L.marker([latitude, longitude], {
                        icon: greenIcon
                    })
                    .addTo(map)
                    .bindPopup("Live Location")
                    .openPopup();
            });
        }

        function findNearbyHospitals(map, latitude, longitude) {
            // Your existing code to find nearby hospitals
            // ...
        }

        // Automatically call the function when the page loads
        document.addEventListener("DOMContentLoaded", function() {
            getLocationsAndShowMap();
        });
    </script>
</body>

</html>