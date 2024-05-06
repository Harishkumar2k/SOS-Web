<?php
session_start();
// Extract id from URL parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['current_location_id'] = $id;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nearby Hospitals</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <style>
        #map {
            height: 400px;
            width: 100%;
        }

        #route-info {
            margin-top: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div id="map" class="map-hgt"></div>
    <div id="route-info"></div>
    <center>
        <a href="accept.php?id=<?php echo $id; ?>">
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
        </a>
    </center>
    <script>
        function createCustomMarker(location, color, title, map) {
            var userIcon = {
                url: 'sos.png', // Path to your custom marker image
                scaledSize: new google.maps.Size(40, 40), // Adjust size as needed
                origin: new google.maps.Point(0, 0), // Set origin to (0, 0)
                anchor: new google.maps.Point(20, 40) // Set anchor to center bottom
            };

            var marker = new google.maps.Marker({
                position: location,
                icon: userIcon,
                map: map,
                title: title
            });

            // Add event listener for SOS marker
            marker.addListener('click', function() {
                calculateAndDisplayRoute(userLocation, location);
            });

            return marker;
        }

        function getLocationsAndShowMap() {
            return fetch('../hospitals.php')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        console.log(data);
                        return {
                            latitude: parseFloat(data[0].latitude),
                            longitude: parseFloat(data[0].longitude)
                        };
                    } else {
                        alert('No locations found in the database.');
                        return null;
                    }
                })
                .catch(error => {
                    console.log("Error: " + error);
                    return null;
                });
        }

        var map;
        var userLocation; // To store user's current location
        var directionsRenderer;
        var directionsService;
        var userMarker;

        function initMap(latitude, longitude) {
            var center = {
                lat: latitude,
                lng: longitude
            };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: center
            });

            directionsRenderer = new google.maps.DirectionsRenderer({
                map: map
            });

            directionsService = new google.maps.DirectionsService();

            // Place marker based on latitude and longitude from data
            createCustomMarker(center, 'blue', 'Your Location', map);

            // Get user's current location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Place marker at user's current location
                    addUserMarker(userLocation, 'Your Logo', 'walk.png', map);
                });
            }

            var request = {
                location: center,
                radius: '5000', // Specify the radius in meters
                type: ['hospital']
            };

            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, function(results, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    for (var i = 0; i < results.length; i++) {
                        var place = results[i];
                        createMarker(place.geometry.location, 'red', place.name, map);
                    }
                }
            });
        }

        function createMarker(location, color, title, map) {
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: title
            });

            // Set the custom marker icon with a specified size
            marker.setIcon({
                url: 'hospital.png',
                scaledSize: new google.maps.Size(32, 32) // Adjust size as needed
            });

            // Add event listener for hospital markers
            marker.addListener('click', function() {
                calculateAndDisplayRoute(userLocation, location);
            });

            return marker;
        }

        // Function to add a user marker with a custom icon
        function addUserMarker(location, title, iconUrl, map) {
            var userIcon = {
                url: iconUrl, // Path to your custom marker image
                scaledSize: new google.maps.Size(40, 40), // Adjust size as needed
                origin: new google.maps.Point(0, 0), // Set origin to (0, 0)
                anchor: new google.maps.Point(20, 40) // Set anchor to center bottom
            };

            var marker = new google.maps.Marker({
                position: location,
                icon: userIcon,
                map: map,
                title: title
            });

            return marker;
        }

        function calculateAndDisplayRoute(origin, destination) {
            // Clear existing directions
            directionsRenderer.setDirections({
                routes: []
            });

            directionsService.route({
                origin: origin,
                destination: destination,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(response);
                    var route = response.routes[0];
                    var distance = 0;
                    var duration = 0;
                    for (var i = 0; i < route.legs.length; i++) {
                        distance += route.legs[i].distance.value; // Distance in meters
                        duration += route.legs[i].duration.value; // Duration in seconds
                    }
                    // Convert distance from meters to kilometers
                    var distanceInKm = distance / 1000;
                    // Convert duration from seconds to minutes
                    var durationInMinutes = duration / 60;
                    // Update HTML elements with distance and duration
                    document.getElementById('route-info').innerHTML = 'Distance: ' + distanceInKm.toFixed(2) + ' km<br>Duration: ' + durationInMinutes.toFixed(2) + ' minutes';
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }

        // Function to add or update the user marker with a custom icon
        function addUserMarker(location, title, iconUrl, map) {
            var userIcon = {
                url: iconUrl, // Path to your custom marker image
                scaledSize: new google.maps.Size(40, 40), // Adjust size as needed
                origin: new google.maps.Point(0, 0), // Set origin to (0, 0)
                anchor: new google.maps.Point(20, 40) // Set anchor to center bottom
            };

            if (!userMarker) {
                userMarker = new google.maps.Marker({
                    position: location,
                    icon: userIcon,
                    map: map,
                    title: title
                });
            } else {
                userMarker.setPosition(location);
            }
        }

        // Function to continuously monitor user's location and update marker
        function watchUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(function(position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    addUserMarker(userLocation, 'Your Location', 'walk.png', map);
                });
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        // Call watchUserLocation() to start monitoring user's location
        watchUserLocation();

        function getMap() {
            getLocationsAndShowMap().then(location => {
                if (location) {
                    initMap(location.latitude, location.longitude);
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            getLocationsAndShowMap().then(location => {
                if (location) {
                    initMap(location.latitude, location.longitude);
                }
            });
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB99Ol78n6mm0nKWURPaqrLPm2jtjYFEKw&libraries=places&callback=getMap" async defer></script>
</body>

</html>