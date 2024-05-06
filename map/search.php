<!DOCTYPE html>
<html>
<head>
    <title>Directions Service with Autocomplete and Animation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
      
        #controls {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        #map {
            flex: 2;
            height: 100%;
        }

        #controls input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #controls button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #controls button:hover {
            background-color: #45a049;
        }

        #info p {
            margin: 5px;
            font-size: 16px;
        }

        .dis-dur{
            display: flex;
            width: 100%;
        }

        #distanceLabel{
            padding-right: 108px;
        }

        @media (max-width: 767px) {
            #mapContainer {
                display: flex;
                flex-direction: row;
                height: 260px;
            }

            #map {
                height: 495px;
            }

            .marg-top{
                margin-top: 15px;
            }

            #controls{
                margin-bottom: -10px;
            }
        }

        @media (min-width: 767px) {
            #mapContainer {
                display: flex;
                flex-direction: row;
                height: 100vh;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-sm-12 col-12 px-0">
                <div id="mapContainer">
                    <div id="controls" class="p-3">
                        <input id="start" class="form-control mb-2" placeholder="Starting Point" />
                        <input id="end" class="form-control mb-2" placeholder="Destination" />
                        <button id="calculateRoute" style="background:#305038;" class="btn btn-primary mb-2">Calculate Route</button>
                        <button id="startNavigation" class="btn btn-success" style="display: none;">Start Navigation</button>
                        <div class="dis-dur mt-3 mb-2">
                            <div>
                                <p id="distanceLabel">Distance: <span  id="distance"></span></p>
                            </div>
                            <div>
                                <p id="durationLabel">Duration: <span  id="duration"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12 col-12 px-0 marg-top">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script>
        var map, directionsService, directionsDisplay, routePolyline, routePath, routeLength, animationIndex, startMarker, endMarker;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 11.1271, lng: 78.6569 }, // Place Where Kings Are Born
                zoom: 7
            });

            directionsService = new google.maps.DirectionsService();

            directionsDisplay = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: true // Prevent default markers from being added
            });

            var startAutocomplete = new google.maps.places.Autocomplete(document.getElementById('start'));
            var endAutocomplete = new google.maps.places.Autocomplete(document.getElementById('end'));

            document.getElementById('calculateRoute').addEventListener('click', calculateRoute);
        }

        function calculateRoute() {
            var start = document.getElementById('start').value;
            var end = document.getElementById('end').value;

            directionsService.route({
                origin: start,
                destination: end,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    var route = response.routes[0];
                    routePath = route.overview_path;
                    routeLength = routePath.length;

                    // Show the Start Navigation button
                    document.getElementById('startNavigation').style.display = 'block';

                    // Update distance and duration
                    var distance = route.legs[0].distance.text;
                    var durationInMinutes = route.legs[0].duration.value / 60;
                    var duration;
                    if (durationInMinutes < 60) {
                        duration = Math.round(durationInMinutes) + ' min'; // Display in minutes
                    } else {
                        duration = Math.round(durationInMinutes / 60) + ' hr'; // Display in hours
                    }
                    document.getElementById('distance').textContent = distance;
                    document.getElementById('duration').textContent = duration;

                    // Create markers for start and end locations with custom icons
                    startMarker = createAMarker(route.legs[0].start_location, 'walk.png', 'Starting Point');
                    endMarker = createAMarker(route.legs[0].end_location, 'sos.png', 'End Point');
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }


        function createAMarker(location, iconUrl, title) {
            var userIcon = {
                url: iconUrl, // Path to your user icon image
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

        document.getElementById('startNavigation').addEventListener('click', startNavigation);

        function startNavigation() {
            animationIndex = 0;
            animateRoute();
        }

        function animateRoute() {
            if (animationIndex < routeLength) {
                var nextPoint = routePath[animationIndex];
                map.panTo(nextPoint);

                if (!routePolyline) {
                    routePolyline = new google.maps.Polyline({
                        path: [],
                        strokeColor: '#FF0000',
                        strokeOpacity: 1.0,
                        strokeWeight: 2,
                        map: map
                    });
                }
                routePolyline.getPath().push(nextPoint);

                // Move the startMarker along with the animation
                startMarker.setPosition(nextPoint);

                animationIndex++;
                setTimeout(animateRoute, 100); // Adjust animation speed as needed
            } else {
                window.alert('Navigation complete.');
            }
        }
    </script>
    <!-- Replace YOUR_API_KEY with your actual API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB99Ol78n6mm0nKWURPaqrLPm2jtjYFEKw&libraries=places&callback=initMap" async defer></script>
</body>
</html>
