<?php

function getLocationName($latitude, $longitude) {
    $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$latitude&lon=$longitude";

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'YourAppName'); // Set a user agent to identify your application

    // Execute cURL session
      $response = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    // Decode JSON response
    $data = json_decode($response, true);

    if (isset($data['display_name'])) {
        return $data['display_name'];
    } else {
        return null;
    }
}

// Example usage
// Example usage with Central Park, New York City coordinates
$latitude = $_GET['lat'];
$longitude = $_GET['long'];
$locationName = getLocationName($latitude, $longitude );

if ($locationName) {
     $lname= "Location Name : $locationName";
} else {
    $lname=  "Unable to get location.";
}

?> <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Display</title>
    <link rel="icon" href="location-icon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f4;
        }
        .image-container {
            width: 100%;
            max-width: 500px;
            margin: 20px 0;
        }
        .image-container img {
            width: 100%;
            height: auto;
        }
        .info-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            width: 100%;
            max-width: 800px;
        }
        .info-item {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px 0;
        }
        .info-item i {
            margin-right: 10px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="image-container">
        <img src="<?php echo $_GET['image_url'] ?>" alt="Top Image">
    </div>
    <div class="info-container">
        <div class="info-item">
            <i class="fas fa-map-marker-alt"></i>
            <span>Latitude: <?php echo $latitude ?></span>
        </div>
        <div class="info-item">
            <i class="fas fa-map-marker-alt"></i>
            <span>Longitude: <?php echo $longitude ?></span>
        </div>
        <div class="info-item">
            <i class="fas fa-location-arrow"></i>
            <span><?php echo $lname ?></span>
        </div>
    </div>
</body>
</html>
