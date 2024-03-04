<?php
declare(strict_types=1);

/**
 * Methode convertDateToApiFormat
 * Cette méthode permet de convertir une date donnée en 2 dates formatées 
 * dans le bon format pour envoyer à l’API
 *
 * @param string $dateFR la date selectionnée au format FR
 * 
 * @return array ["dateMatin" => string, "dateSoir" => string] tableau contenant les 2 dates
 */
function convertDateToApiFormat(string $dateFR): array
{
    // Convertir la date au format AAAA-MM-JJ
    $dateEN= date("Y-m-d", strtotime(str_replace('/', '-', $dateFR)));

    // Ajouter l'heure "00:00:00Z" à la date
    $dateMatin = $dateEN . "T0:00:00Z";
    $dateSoir = $dateEN . "T23:00:00Z";

    return ["dateMatin" => $dateMatin, "dateSoir" => $dateSoir];
}

/**
 * Methode convertDateToDisplayFormat
 * Cette méthode permet de convertir une date à afficher au format FR
 *
 * @param string $dateComplete la date a transformer
 *
 * @return string $dateFR la date au format FR
 */
function convertDateToDisplayFormat(string $dateComplete): string 
{
    // Convertir la date en timestamp
    $date = DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $dateComplete);

    // Formater la date dans le format JJ/MM/AAAA
    $dateFR = $date->format('d/m/Y H:i:s');

    return $dateFR;
}


/**
 * Methode getDisplayFromAqi
 * Cette méthode retourne une couleur en fonction du retour aqi par l’API
 *
 * @param string $aqi le nombre qui représente le retour de la qualité de l’air par l’IPA
 *
 * @return string $color la couleur correspondante
 */
function getDisplayFromAqi(string $aqi): string
{
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
