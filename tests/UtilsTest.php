<?php

use PHPUnit\Framework\TestCase;

require_once '../src/utils.php';

class UtilsTest extends TestCase
{    
    /**
     * Method testConvertDateToApiFormat
     * Permet de tester le résultat correct de la fonction
     *
     * @return void
     */
    public function testOKConvertDateToApiFormat()
    {
        // Date de test au format français
        $dateFR = '04/03/2024';

        // Appel de la fonction à tester
        $result = convertDateToApiFormat($dateFR);

        // Vérification des résultats attendus
        $this->assertEquals([
            "dateMatin" => "2024-03-04T0:00:00Z",
            "dateSoir" => "2024-03-04T23:00:00Z"
        ], $result);
    }
        
    /**
     * Method testKOConvertDateToApiFormat
     * Permet de tester le résultat incorrect de la fonction
     *
     * @return void
     */
    public function testKOConvertDateToApiFormat()
    {
        // Date de test au format français
        $dateFR = '31/12/2022';

        // Appel de la fonction à tester
        $result = convertDateToApiFormat($dateFR);

        // Les résultats attendus sont incorrects pour cette date
        $this->assertNotEquals([
            "dateMatin" => "2022-12-31", // Date attendue incorrecte
            "dateSoir" => "2022-12-31"   // Date attendue incorrecte
        ], $result);
    }
}
