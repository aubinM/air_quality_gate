<?php

class ApiResponseParser
{
    public static function parse($json)
    {
        $parsedData = [];
        $response = json_decode($json, true);

        if (isset($response['hoursInfo']) && is_array($response['hoursInfo'])) {
            foreach ($response['hoursInfo'] as $hourInfo) {
                if (isset($hourInfo['dateTime'], $hourInfo['indexes'][0]['category'])) {
                    $parsedData[] = [
                        'dateTime' => $hourInfo['dateTime'],
                        'category' => $hourInfo['indexes'][0]['category']
                    ];
                }
            }
        }

        return $parsedData;
    }
}

// Exemple d'utilisation :
$jsonResponse = '{
  "hoursInfo": [
    {
      "dateTime": "2024-01-29T23:00:00Z",
      "indexes": [
        {
          "code": "uaqi",
          "displayName": "Universal AQI",
          "aqi": 64,
          "aqiDisplay": "64",
          "color": {
            "red": 0.65882355,
            "green": 0.8666667,
            "blue": 0.13725491
          },
          "category": "Bonne qualité de l\'air",
          "dominantPollutant": "pm10"
        }
      ]
    },
    {
      "dateTime": "2024-01-29T22:00:00Z",
      "indexes": [
        {
          "code": "uaqi",
          "displayName": "Universal AQI",
          "aqi": 51,
          "aqiDisplay": "51",
          "color": {
            "red": 0.972549,
            "green": 0.9882353,
            "blue": 0.007843138
          },
          "category": "Qualité de l\'air modérée",
          "dominantPollutant": "pm10"
        }
      ]
    }
  ],
  "regionCode": "fr",
  "nextPageToken": "CioaEgnfwrrx7m5IQBGpa+19qqoCQDIQCgYIgNXbrQYSBgjw2+CtBlICRlIQAhoTMjAyNC0wMS0yOVQyMzowMDowMA=="
}';

$parsedData = ApiResponseParser::parse($jsonResponse);
print_r($parsedData);

?>
