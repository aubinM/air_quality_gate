<?php
declare(strict_types=1);

/**
 * ApiResponseParser
 * Cette classe permet de parser des données pour seulement récupérer les données utiles
 */
class ApiResponseParser
{
        
    /**
     * Method parse
     *
     * @param string $json données a parser
     *
     * @return array $parsedData tableau de données contenant les données utiles
     */
    public static function parse(string $json): array
    {
        $parsedData = [];
        $response = json_decode($json, true);

        if (isset($response['hoursInfo']) && is_array($response['hoursInfo'])) {
            foreach ($response['hoursInfo'] as $hourInfo) {
                if (isset($hourInfo['dateTime'], $hourInfo['indexes'][0]['category'])) {
                    $parsedData[] = [
                        'dateTime' => $hourInfo['dateTime'],
                        'category' => $hourInfo['indexes'][0]['category'],
                        'aqi' => $hourInfo['indexes'][0]['aqi']
                    ];
                }
            }
        }
        return $parsedData;
    }
}
