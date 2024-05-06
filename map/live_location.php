<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live User Location</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
            margin-top:100px;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9MyKTTfsB75z6X_eSItaJTKujc_LQ-R8&callback=initMap"  defer></script>
</head>
<body>
    <h1>Your Live Location</h1>
    <div id="map"></div>
    <p id="location-info"></p>
    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
            });
            const locationInfo = document.getElementById("location-info");

            // Geolocation API with error handling and privacy considerations
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const coords = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        // Center the map on the user's location
                        map.setCenter(coords);

                        // Create a marker at the user's location
                        const marker = new google.maps.Marker({
                            position: coords,
                            map: map,
                            title: "Your Location",
                        });

                        // Reverse geocoding to fetch address
                        fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${coords.lat},${coords.lng}&key=AIzaSyC9MyKTTfsB75z6X_eSItaJTKujc_LQ-R8`)
                            .then((response) => response.json())
                            .then((data) => {
                                const address = data.results[0].formatted_address || "Address unavailable";
                                locationInfo.textContent = `Latitude: ${coords.lat}, Longitude: ${coords.lng}, Address: ${address}`;
                            })
                            .catch((error) => {
                                console.error("Error fetching address:", error);
                                locationInfo.textContent = "Error: Could not retrieve address.";
                            });
                    },
                    (error) => {
                        console.error("Error getting user location:", error);
                        locationInfo.textContent =
                            "Error: Could not access your location. Please check permissions or enable location services.";
                    }
                );
            } else {
                locationInfo.textContent =
                    "Geolocation is not supported by this browser.";
            }
        }
    </script>
</body>
</html>
