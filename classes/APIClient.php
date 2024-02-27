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
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        $response = curl_exec($curl);
        
        if ($response === false) {
            throw new Exception(curl_error($curl));
        }
        
        curl_close($curl);
        
        return json_decode($response, true);
    }
}
?>
