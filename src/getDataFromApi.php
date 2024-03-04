<?php
declare(strict_types=1);
session_start();
require_once('../classes/APIClient.php');
require_once('../classes/APIresponseParser.php');
require_once('../classes/City.php');
require_once('../classes/PostDataBuilder.php');
require_once('utils.php');
// Redirection
header('Location: ../index.php');


// Selection de la ville
if ($_GET['city'] === "paris") {
    $_SESSION['selectedCity'] = $paris;
} elseif ($_GET['city'] === "reims") {
    $_SESSION['selectedCity'] = $reims;
} else {
    $_SESSION['selectedCity'] = "";
}

// Parse du fichier env pour récupérer le jeton API
$env = parse_ini_file('../.env.local');
$api_key = $env['API_KEY'];
$api = new APIClient('https://airquality.googleapis.com/v1/');

// Récupération de la date selectionnée + mise au format pour envoie API
$dateFR = $_GET['date'];
$_SESSION['selectedDate'] = $dateFR;
$dates = convertDateToApiFormat($dateFR);
$startTime = $dates["dateMatin"];
$endTime = $dates["dateSoir"];

// Récupération latitude/longitute en fonction de la ville selectio,née
$latitude = $_SESSION['selectedCity']->getLatitude();
$longitude = $_SESSION['selectedCity']->getLongitude();

// Execution du call API 
try {

    //Constuction du corps de la requête
    $postDataBuilder = new PostDataBuilder($startTime, $endTime, $latitude, $longitude);
    $postData = $postDataBuilder->build();

    // Envoie de la requête API
    $response = $api->post('history:lookup?key=' . $api_key, $postData);

    // Parsing de la réponse
    $parsedData = ApiResponseParser::parse(json_encode($response));
    // Stockage des données en session
    $_SESSION['datas'] = $parsedData;

} catch (Exception $e) {
    // Gestion de l'erreur API
    $_SESSION['APIerror'] = "Erreur lors de la requête, veuillez contacter un administrateur.";
}

