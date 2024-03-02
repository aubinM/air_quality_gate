<?php
declare(strict_types=1);

/**
 * PostDataBuilder
 * Classe permettant de construire le corps de la requête API
 */
class PostDataBuilder
{
    private $period;
    private $pageSize;
    private $pageToken;
    private $location;
    private $languageCode;
    
    /**
     * Method __construct
     *
     * @param string $startTime Date de début de récupération des données
     * @param string $endTime  Date de fin de récupération des données
     * @param string $latitude Latitude de la ville souhaitée
     * @param string $longitude Longitude de la ville souhaitée
     *
     * @return void
     */
    public function __construct(string $startTime, string $endTime, float $latitude, float $longitude)
    {
        $this->period = [
            "startTime" => $startTime,
            "endTime" => $endTime
        ];
        $this->pageSize = "24";
        $this->pageToken = "";
        $this->location = [
            "latitude" => $latitude,
            "longitude" => $longitude
        ];
        $this->languageCode = "fr";
    }
    
    /**
     * Method build
     * Construction du corps de la reqsuête
     *
     * @return string
     */
    public function build(): string|false
    {
        $requestData = [
            "period" => $this->period,
            "pageSize" => $this->pageSize,
            "pageToken" => $this->pageToken,
            "location" => $this->location,
            "languageCode" => $this->languageCode
        ];

        return json_encode($requestData);
    }
}

