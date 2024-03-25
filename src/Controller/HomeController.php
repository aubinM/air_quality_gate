<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Service\APIClient;
use App\Service\ApiResponseParser;
use App\Service\City;
use App\Service\PostDataBuilder;
use App\Entity\ApiForm;
use Exception;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{
     
    /**
     * Method permettant d'afficher la page principale
     *
     * @param Request $request Requête entrante
     *
     * @return Response
     */
    #[Route('/', name: 'app_home')]   
    public function index(Request $request): Response
    {

        // Création du formulaire
        $apiForm = new ApiForm();
        $apiForm->setVille('Paris');

        $form = $this->createFormBuilder($apiForm)
            ->add('ville', ChoiceType::class, [
                'choices'  => [
                    'Paris' => 'Paris',
                    'Reims' => 'Reims',
                ],
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd/MM/yyyy',
                'data' => new \DateTime('yesterday', new \DateTimeZone('Europe/Paris')),
                'required' => true,
                'label' => 'Date',
                'mapped' => true,
            ])
            ->add('save', SubmitType::class, ['label' => 'Valider'])
            ->getForm();

        $form->handleRequest($request);
        
        // Check si le formulair a été submit et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $ville = $data->getVille();
            if ($ville === "Paris") {
                $selectedCity = new City($ville, 48.866667, 2.333333);
            } else {
                $selectedCity = new City($ville, 49.258329, 4.031696);
            }

            $date = $data->getDate()->format('Y-m-d');

            // Récupération du jeton API
            $api_key = $this->getParameter('app.api_key');
            $api = new APIClient('https://airquality.googleapis.com/v1/');

            // // Récupération de la date selectionnée + mise au format pour envoie API
            $dates = $this->convertDateToApiFormat($date);
            $startTime = $dates["dateMatin"];
            $endTime = $dates["dateSoir"];

            // // Récupération latitude/longitute en fonction de la ville selectio,née
            $latitude = $selectedCity->getLatitude();
            $longitude =  $selectedCity->getLongitude();

            // // Execution du call API 
            try {

            //Constuction du corps de la requête
            $postDataBuilder = new PostDataBuilder($startTime, $endTime, $latitude, $longitude);
            $postData = $postDataBuilder->build();

            // Envoie de la requête API
            $response = $api->post('history:lookup?key=' . $api_key, $postData);

            // Parsing de la réponse
            $parsedData = ApiResponseParser::parse(json_encode($response));
            // Stockage des données en session
            $_SESSION['datas'] = $parsedData;

            } catch (Exception $e) {
                // Gestion de l'erreur API
                $error = "Erreur lors de la requête, veuillez contacter un administrateur.";
                return $this->render('home/index.html.twig', [
                    'controller_name' => 'HomeController',
                    'form' => $form,
                    'error' => $error,
                ]);
            }

            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'form' => $form,
                'data' => $parsedData,
                'city' => $ville
            ]);
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form,
        ]);
    }

    /**
     * Methode convertDateToApiFormat
     * Cette méthode permet de convertir une date donnée en 2 dates formatées 
     * dans le bon format pour envoyer à l’API
     *
     * @param string $dateFR la date selectionnée au format FR
     * 
     * @return array ["dateMatin" => string, "dateSoir" => string] tableau contenant les 2 dates
     */
    function convertDateToApiFormat(string $dateFR): array
    {
        // Convertir la date au format AAAA-MM-JJ
        $dateEN = date("Y-m-d", strtotime(str_replace('/', '-', $dateFR)));

        // Ajouter l'heure "00:00:00Z" à la date
        $dateMatin = $dateEN . "T0:00:00Z";
        $dateSoir = $dateEN . "T23:00:00Z";

        return ["dateMatin" => $dateMatin, "dateSoir" => $dateSoir];
    }
}
