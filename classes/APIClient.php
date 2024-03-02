<?php
declare(strict_types=1);

/**
 * APIClient
 * Classe permettant de gérer des appels à une API
 */
class APIClient {
    private $baseURL;
        
    /**
     * Method __construct
     *
     * @param $baseURL $baseURL URL de base de l'API a consommé
     *
     * @return void
     */
    public function __construct(string $baseURL) {
        $this->baseURL = $baseURL;
    }
        
    
    /**
     * Method post
     * Cette méthode permet d'envoyer des données via la method POST avec curl
     *
     * @param string $endpoint point de terminaison API
     * @param string $data donnée du corps de la requête
     *
     * @return mixed json_decode($response, true)
     */
    public function post(string $endpoint, string $data): mixed {

        // Construction de l'url
        $url = $this->baseURL . $endpoint;
        
        // Init du curl
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        // Execution de la requête API
        $response = curl_exec($curl);
        
        // Gestion des cas d'erreurs API
        if (array_key_exists('error', json_decode($response, true))) {
            throw new Exception($response);
        } else {
            unset($_SESSION['APIerror']);
        }
        
        curl_close($curl);
        
        return json_decode($response, true);
    }
}

