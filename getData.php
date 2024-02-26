<?php 
session_start();

include('classes/APIClient.php');
include('classes/City.php');

if($_GET['city'] === "paris"){
    $_SESSION['selectedCity'] = $paris;
} elseif ($_GET['city'] === "reims") {
    $_SESSION['selectedCity'] = $reims;
} else {
    $_SESSION['selectedCity'] = "";
}

header('Location: index.php');

