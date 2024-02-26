<?php

class City {
    private string $name;
    private float $latitude;
    private float $longitude;
    private array $historique;

    public function __construct(string $name, float $latitude, float $longitude, array $historique) {
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->historique = $historique;
    }

    public function getName(): string{
        return $this->name;
    }

    public function setName($name): void{
        $this->name = $name;
    }

    public function getLatitude(): float {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): void {
        $this->latitude = $latitude;
    }

    public function getLongitude(): float {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): void {
        $this->longitude = $longitude;
    }

    public function getHistorique(): array {
        return $this->historique;
    }

    public function setHistorique(array $historique): void {
        $this->historique = $historique;
    }
}

// Exemple d'utilisation :
$paris = new City("Paris", 48.866667, 2.333333, []);
$reims = new City("Reims", 49.258329, 4.031696, []);

// echo "Latitude : " . $ville->getLatitude() . "\n";
// echo "Longitude : " . $ville->getLongitude() . "\n";
// echo "Historique :\n";
// foreach ($ville->getHistorique() as $event) {
//     echo "- $event\n";
// }

?>
