<?php

namespace App\Controller\Rest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MapsController extends AbstractRestController
{
    /**
     * @Rest\Get(path="/maps/places")
     */
    public function index(Request $request,
                          ParameterBagInterface $parameterBag,
                          HttpClientInterface $httpClient)
    {
        try {
            $response = $httpClient->request('GET', "https://api.mapbox.com/geocoding/v5/mapbox.places/{$request->query->get('input')}.json", [
                'query' => [
                    'access_token' => $parameterBag->get("GOOGLE_API_KEY"),
                    'types' => 'address,place'
                ]
            ]);
        } catch (TransportExceptionInterface $exception) {
            $this->handleView($this->view($exception, 200));
        }
        return $this->handleView($this->view($response->toArray(), 200));
    }
}
