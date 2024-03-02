<?php
declare(strict_types=1);

/**
 * City
 * Cette classe représente une ville
 */
class City {
    private string $name;
    private float $latitude;
    private float $longitude;
    
    /**
     * Method __construct
     *
     * @param string $name Nom de la ville
     * @param float $latitude Latitude de la ville
     * @param float $longitude Longitude de la ville
     *
     * @return void
     */
    public function __construct(string $name, float $latitude, float $longitude) {
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
    
    /**
     * Method getName
     *
     * @return string
     */
    public function getName(): string{
        return $this->name;
    }
    
    /**
     * Method setName
     *
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void{
        $this->name = $name;
    }
    
    /**
     * Method getLatitude
     *
     * @return float
     */
    public function getLatitude(): float {
        return $this->latitude;
    }
    
    /**
     * Method setLatitude
     *
     * @param float $latitude
     *
     * @return void
     */
    public function setLatitude(float $latitude): void {
        $this->latitude = $latitude;
    }
    
    /**
     * Method getLongitude
     *
     * @return float
     */
    public function getLongitude(): float {
        return $this->longitude;
    }
    
    /**
     * Method setLongitude
     *
     * @param float $longitude
     *
     * @return void
     */
    public function setLongitude(float $longitude): void {
        $this->longitude = $longitude;
    }

}

// Initialisation des 2 villes
$paris = new City("Paris", 48.866667, 2.333333);
$reims = new City("Reims", 49.258329, 4.031696);

