<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="stylesheet.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9MyKTTfsB75z6X_eSItaJTKujc_LQ-R8&callback=initMap" defer></script>
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

<body>
  <?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
  <?php include("header.php"); ?>
  <section>
    <div class="frame" style="justify-content:center; text-align:center;">
      <div class="container">
        <div class="col-md-12 mt-5">
          <img class="screenshot" style="width:150px;" src="https://c.animaapp.com/61CXDTV0/img/screenshot-2023-08-29-112643-2@2x.png" />
          <p class="ACC-ROAD-CARE acc-sos">ACCIDENT <span class="text-wrapper-2">SOS </span></p>
        </div>
        <form action="#" method="post">
          <div class="col-md-12 mt-5">
            <div class="row">
              <div class="col-md-6">
                <div class="fw-bold fs-18 mb-4">Two Wheeler</div>
                <input type="radio" style="width:100px; height: 30px;" name="vehicle" value="Two wheeler">
              </div>
              <div class="col-md-6">
                <div class="fw-bold fs-18 mb-4">Four Wheeler</div>
                <input type="radio" style="width:100px; height: 30px;" name="vehicle" value="Four wheeler">
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-5 sos-btn">
            <!-- <button onclick="showLocationDetails(event)">Alert</button> -->

            <button onclick="showLocationDetails(event); playNotificationSound();" class="button-82-pushable" role="button">
              <span class="button-82-shadow"></span>
              <span class="button-82-edge"></span>
              <span class="button-82-front text">
                Alert
              </span>
            </button>

            <p id="location-info" style="display: none;"></p>
          </div>
        </form>
      </div>
    </div>
  </section>

  <audio id="notificationSound">
    <source src="audio/sos.wav" type="audio/wav">
    Your browser does not support the audio element.
  </audio>

 

  <script>
    function playNotificationSound() {
      console.log('Playing notification sound...');
      // Get the audio element
      var audio = document.getElementById("notificationSound");
      // Play the sound
      audio.play();
      // Stop the sound after 5 seconds
      setTimeout(function() {
        audio.pause();
        audio.currentTime = 0;
      }, 5000); // 5000 milliseconds = 5 seconds
    }
  </script>

  <script>
    function initMap() {
      // This function is unchanged from the original code
      // You can leave it as it is
    }

    function showLocationDetails(event) {
      event.preventDefault(); // Prevent the default form submission behavior
      const locationInfo = document.getElementById("location-info");
      const selectedVehicle = document.querySelector('input[name="vehicle"]:checked');
      // Set the default vehicle to "Four Wheeler" if no option is selected
      const vehicle = selectedVehicle ? selectedVehicle.value : "Emergency";

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
                locationInfo.style.display = "none";

                // Send location details to the server
                saveLocationDetails(coords.lat, coords.lng, address, vehicle);
              })
              .catch((error) => {
                console.error("Error fetching address:", error);
                locationInfo.textContent = "Error: Could not retrieve address.";
                locationInfo.style.display = "none";
              });
          },
          (error) => {
            console.error("Error getting user location:", error);
            locationInfo.textContent = "Error: Could not access your location. Please check permissions or enable location services.";
            locationInfo.style.display = "none";
          }
        );
      } else {
        locationInfo.textContent = "Geolocation is not supported by this browser.";
        locationInfo.style.display = "none";
      }
    }


    function saveLocationDetails(latitude, longitude, address, vehicle) {
      // Send a POST request to the server with location details
      fetch('alert_action.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            vehicle: vehicle,
            latitude: latitude,
            longitude: longitude,
            address: address
          }),
        })
        .then(response => response.text())
        .then(data => {
          // Call handleResponse function to handle the server response
          handleResponse(data);
        })
        .catch(error => {
          // Print any errors to the console
          console.error('Error saving location details:', error);
        });
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    function handleResponse(response) {
      console.log(response);
      if (response === "Data updated successfully.") {
        Swal.fire({
          title: 'Success!',
          text: 'Alert Has Been Sent.',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'home1.php'; // Redirect to home1.php
          }
        });
      } else {
        Swal.fire({
          title: 'Error!',
          text: 'Error: Data not updated.',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    }
  </script>


</body>

</html>