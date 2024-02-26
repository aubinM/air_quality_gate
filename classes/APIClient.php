<?php

class APIClient {
    private $baseURL;
    
    public function __construct($baseURL) {
        $this->baseURL = $baseURL;
    }
    
    public function post($endpoint, $data = array()) {
        $url = $this->baseURL . $endpoint;
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        
        $response = curl_exec($curl);
        
        if ($response === false) {
            throw new Exception(curl_error($curl));
        }
        
        curl_close($curl);
        
        return json_decode($response, true);
    }
}

// Example usage:
// $api = new APIClient("https://api.example.com/");
// try {

//     $postData = array("key1" => "value1", "key2" => "value2");
//     $postDataResponse = $api->post("endpoint", $postData);
//     var_dump($postDataResponse);
// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage();
// }
?>
