
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Get Location Address</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <button onclick="getLocationAndShowMap()">Get Location</button>
    <p id="location"></p>
    <div id="map" style="height: 400px;"></div>

    <script>
        function getLocationAndShowMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            let latitude = position.coords.latitude;
            let longitude = position.coords.longitude;
            let locationText = "Latitude: " + latitude + "<br>Longitude: " + longitude;

            // Make a request to the Nominatim API for reverse geocoding
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                .then(response => response.json())
                .then(data => {
                    if (data.display_name) {
                        locationText += "<br>Address: " + data.display_name;
                        showMapAndDirections(data.display_name, latitude, longitude);
                    } else {
                        locationText += "<br>Address not found";
                    }
                    document.getElementById("location").innerHTML = locationText;
                })
                .catch(error => {
                    console.log("Error: " + error);
                });
        }

        function showMapAndDirections(destinationAddress, latitude, longitude) {
            // Initialize the map
            var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Use OpenCage Data API to geocode the destination address
            fetch(`https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(destinationAddress)}&key=0f956d71e33944c6bae83a317d2decb2`)
                .then(response => response.json())
                .then(data => {
                    if (data.results.length > 0) {
                        var destinationCoordinates = data.results[0].geometry;

                        // Add a marker for the destination
                        var destinationMarker = L.marker([destinationCoordinates.lat, destinationCoordinates.lng]).addTo(map);
                        destinationMarker.bindPopup(destinationAddress).openPopup();

                        // Create a route from current location to the destination
                        L.Routing.control({
                            waypoints: [
                                L.latLng(latitude, longitude),
                                L.latLng(destinationCoordinates.lat, destinationCoordinates.lng)
                            ]
                        }).addTo(map);
                    } else {
                        console.log("Destination address not found.");
                    }
                })
                .catch(error => {
                    console.log("Error: " + error);
                });
        }
    </script>
</body>
</html>
