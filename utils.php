<?php

function convert_date_to_api_format($dateFR): array
{
    // Convertir la date au format AAAA-MM-JJ
    $dateEN= date("Y-m-d", strtotime(str_replace('/', '-', $dateFR)));

    // Ajouter l'heure "00:00:00Z" à la date
    $dateMatin = $dateEN . "T0:00:00Z";
    $dateSoir = $dateEN . "T23:00:00Z";

    return ["dateMatin" => $dateMatin, "dateSoir" => $dateSoir];
}

function convert_date_to_display_format($dateComplete)
{
    // Convertir la date en timestamp
    $date = DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $dateComplete);

    // Formater la date dans le format JJ/MM/AAAA
    $dateFR = $date->format('d/m/Y H:i:s');

    return $dateFR;
}

function getDisplayFromAqi(string $aqi): string
{
    $color = "";
    $aqiNumber = (int)$aqi;
    switch ($aqiNumber) {
        case $aqiNumber >= 80 && $aqiNumber <= 100:
            $color = "custom-bg-perfect";
            break;
        case $aqiNumber >= 60 && $aqiNumber <= 79:
            $color = "custom-bg-good";
            break;
        case $aqiNumber >= 40 && $aqiNumber <= 59:
            $color = "custom-bg-middle";
            break;
        case $aqiNumber >= 20 && $aqiNumber <= 39:
            $color = "custom-bg-bad";
            break;
        case $aqiNumber >= 1 && $aqiNumber <= 19:
            $color = "custom-bg-verybad";
            break;
        case $aqiNumber == 0:
            $color = "custom-bg-severe";
            break;
        default:
            $color = "bg-dark";
    }

    return $color;
}
