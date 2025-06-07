<?php
if (isset($_GET['city']) || (isset($_GET['latitude']) && isset($_GET['longitude']))) {
    // Replace with your actual GoMaps and OpenWeatherMap API keys
    $gomaps_api_key = 'AlzaSymWP7Ygm8P91itEuS9Dag4Aseysl0fhYfX';
    $weather_api_key = '80a7bcf4e65b5819546418180ae69e7b';

    // Determine location
    if (!empty($_GET['city'])) {
        $location = urlencode($_GET['city']);
        $weather_url = "https://api.openweathermap.org/data/2.5/weather?q=$location&appid=$weather_api_key&units=metric";
    } elseif (!empty($_GET['latitude']) && !empty($_GET['longitude'])) {
        $latitude = $_GET['latitude'];
        $longitude = $_GET['longitude'];
        $location = "$latitude, $longitude";
        $weather_url = "https://api.openweathermap.org/data/2.5/weather?lat=$latitude&lon=$longitude&appid=$weather_api_key&units=metric";
    } else {
        echo "<p>Please enter a valid location.</p>";
        exit;
    }

    // Function to fetch data using cURL
    function fetchData($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "<p>Error fetching data: " . curl_error($ch) . "</p>";
            curl_close($ch);
            return null;
        }

        curl_close($ch);
        return json_decode($response, true);
    }

    // Fetch Weather Data
    $weather_data = fetchData($weather_url);
    if (!$weather_data || !isset($weather_data['main'])) {
        echo "<p>Weather data not available.</p>";
        exit;
    }

    $temp = $weather_data['main']['temp'] ?? 'N/A';
    $weather_desc = $weather_data['weather'][0]['description'] ?? 'N/A';

    // Function to fetch places from GoMaps API
    function fetchPlaces($query, $gomaps_api_key) {
        $url = "https://maps.gomaps.pro/maps/api/place/textsearch/json?query=" . urlencode($query) . "&key=$gomaps_api_key";
        return fetchData($url);
    }

    // Fetch nearby locations using GoMaps API
    $places_data = fetchPlaces("tourist attractions in $location", $gomaps_api_key);
    $restaurants_data = fetchPlaces("restaurants in $location", $gomaps_api_key);
    $hotels_data = fetchPlaces("hotels in $location", $gomaps_api_key);

    // Display Weather Info
    echo "<h2>Weather in " . htmlspecialchars($_GET['city'] ?? "$latitude, $longitude") . "</h2>";
    echo "<p> <b> 🌡 Temperature : </b> " . htmlspecialchars($temp) . " <b>°C</b></p>";
    echo "<p> <b> ☁️ Condition : </b>" . htmlspecialchars($weather_desc) . "</p>";

    // Function to display results
    function displayResults($title, $data) {
        echo "<h3>$title</h3><ul>";
        if (!empty($data['results'])) {
            foreach ($data['results'] as $item) {
                echo "<li>" . htmlspecialchars($item['name']) . "</li>";
            }
        } else {
            echo "<li>No data available.</li>";
        }
        echo "</ul>";
    }

    // Display fetched places
    displayResults("Restaurants", $restaurants_data);
    displayResults("Hotels", $hotels_data);
    displayResults("Tourist Places", $places_data);
} else {
    echo "<p>Please enter a location.</p>";
}
?>