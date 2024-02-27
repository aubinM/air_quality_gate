<?php
session_start();

include('classes/APIClient.php');
include('classes/APIresponseParser.php');
include('classes/City.php');
include('classes/PostDataBuilder.php');

if ($_GET['city'] === "paris") {
    $_SESSION['selectedCity'] = $paris;
} elseif ($_GET['city'] === "reims") {
    $_SESSION['selectedCity'] = $reims;
} else {
    $_SESSION['selectedCity'] = "";
}

$date = $_GET['date'];
$env = parse_ini_file('.env');
$api_key = $env['API_KEY'];
$api = new APIClient('https://airquality.googleapis.com/v1/');

$startTime = "2024-01-29T00:00:00Z";
$endTime = "2024-01-29T23:00:00Z";

$latitude = $_SESSION['selectedCity']->getLatitude();
$longitude = $_SESSION['selectedCity']->getLongitude();


try {

    $postDataBuilder = new PostDataBuilder($startTime, $endTime, $latitude, $longitude);
    $postData = $postDataBuilder->build();
    $response = $api->post('history:lookup?key=' . $api_key, $postData);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$parsedData = ApiResponseParser::parse(json_encode($response));

$_SESSION['datas'] = $parsedData;

header('Location: index.php');
