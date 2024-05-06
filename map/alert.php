<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live User Location</title>
    <style>
        #location-info {
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9MyKTTfsB75z6X_eSItaJTKujc_LQ-R8&callback=initMap" defer></script>
</head>
<body>
    <h1>Your Live Location</h1>
    <button onclick="showLocationDetails()">Show Location Details</button>
    <p id="location-info" style="display: none;"></p>
    <script>
        function initMap() {
            // This function is unchanged from the original code
            // You can leave it as it is
        }

        function showLocationDetails() {
            const locationInfo = document.getElementById("location-info");

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const coords = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        // Reverse geocoding to fetch address
                        fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${coords.lat},${coords.lng}&key=AIzaSyC9MyKTTfsB75z6X_eSItaJTKujc_LQ-R8`)
                            .then((response) => response.json())
                            .then((data) => {
                                const address = data.results[0].formatted_address || "Address unavailable";
                                const locationDetails = `Latitude: ${coords.lat}, Longitude: ${coords.lng}, Address: ${address}`;
                                locationInfo.innerHTML = locationDetails;
                                locationInfo.style.display = "block";

                                // Send location details to the server
                                saveLocationDetails(coords.lat, coords.lng, address);
                            })
                            .catch((error) => {
                                console.error("Error fetching address:", error);
                                locationInfo.textContent = "Error: Could not retrieve address.";
                                locationInfo.style.display = "block";
                            });
                    },
                    (error) => {
                        console.error("Error getting user location:", error);
                        locationInfo.textContent = "Error: Could not access your location. Please check permissions or enable location services.";
                        locationInfo.style.display = "block";
                    }
                );
            } else {
                locationInfo.textContent = "Geolocation is not supported by this browser.";
                locationInfo.style.display = "block";
            }
        }

        function saveLocationDetails(latitude, longitude, address) {
            // Send a POST request to the server with location details
            fetch('../alert_action.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    vehicle: 'Two Wheeler', // Replace with actual vehicle details
                    latitude: latitude,
                    longitude: longitude,
                    address: address
                }),
            })
            .then(response => {
                if (response.ok) {
                    console.log('Location details saved successfully');
                } else {
                    console.error('Failed to save location details');
                }
            })
            .catch(error => {
                console.error('Error saving location details:', error);
            });
        }
    </script>
</body>
</html>
