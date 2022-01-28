<?php 

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CallAeroportApi extends AbstractController

{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAeroport():array
    {
        $apiAirportKey = $this->getParameter('app.ApiAirportKey');
        $apiUrl = "http://api.aviationstack.com/v1/airports?access_key=".$apiAirportKey;
        $response = $this->client->request(
            'GET',
            $apiUrl
        );

        return $response->toArray();
    }
}


?>