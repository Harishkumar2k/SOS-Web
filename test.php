<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Location Address</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <div id="map" style="height: 400px;"></div>
    <p id="location"></p>

    <script>
        // Function to get location based on page load
        function getLocationOnLoad() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Function to display the location
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
                    } else {
                        locationText += "<br>Address not found";
                    }
                    document.getElementById("location").innerHTML = locationText;

                    // Initialize the map
                    var map = L.map('map').setView([latitude, longitude], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    // Create a green marker icon
                    var greenIcon = new L.Icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    });

                    // Display a green marker at the live location
                    L.marker([latitude, longitude], { icon: greenIcon })
                        .addTo(map)
                        .bindPopup("Live Location")
                        .openPopup();
                })
                .catch(error => {
                    console.log("Error: " + error);
                });
        }

        // Call the function on page load
        document.addEventListener("DOMContentLoaded", getLocationOnLoad);
    </script>
</body>
</html>
