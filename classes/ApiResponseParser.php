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
                        'category' => $hourInfo['indexes'][0]['category'],
                        'aqi' => $hourInfo['indexes'][0]['aqi']
                    ];
                }
            }
        }

        return $parsedData;
    }
}

?>
