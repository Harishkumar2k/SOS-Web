<!DOCTYPE html>
<html>

<head>
    <title>Simple Navigation Example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include the Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB99Ol78n6mm0nKWURPaqrLPm2jtjYFEKw&callback=initMap" async defer></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Map container -->
    <div id="map"></div>

    <script>
        // Initialize and display the map
        function initMap() {
            // Specify the coordinates for the starting and ending points
            var start = { lat: 13.0289148, lng: 80.0185282};
            var end = { lat: 13.0449408, lng: 80.19968 };

            // Create a new map centered at the starting point
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10, // Adjust the zoom level as needed
                center: start // Center the map at the starting point
            });

            // Create a directions service object to calculate directions
            var directionsService = new google.maps.DirectionsService();

            // Create a directions renderer object to display directions on the map
            var directionsRenderer = new google.maps.DirectionsRenderer({
                map: map
            });

            // Set up the request object for directions
            var request = {
                origin: start, // Starting point
                destination: end, // Ending point
                travelMode: 'DRIVING' // Specify the travel mode (DRIVING, WALKING, BICYCLING, TRANSIT)
            };

            // Use the directions service to calculate directions
            directionsService.route(request, function (response, status) {
                if (status === 'OK') {
                    // Display the directions on the map
                    directionsRenderer.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>
</body>

</html>
