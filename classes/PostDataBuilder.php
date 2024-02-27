<?php

class PostDataBuilder
{
    private $period;
    private $pageSize;
    private $pageToken;
    private $location;
    private $languageCode;

    public function __construct($startTime, $endTime, $latitude, $longitude)
    {
        $this->period = [
            "startTime" => $startTime,
            "endTime" => $endTime
        ];
        $this->pageSize = "1";
        $this->pageToken = "";
        $this->location = [
            "latitude" => $latitude,
            "longitude" => $longitude
        ];
        $this->languageCode = "fr";
    }

    public function build()
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


?>
