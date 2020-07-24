<?php

namespace App\Handler\Query\Place;

use App\DTO\Place\PlaceDTO;
use App\Query\Place\ById;
use App\Repository\PlaceRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ByIdHandler implements MessageHandlerInterface
{
    /** @var PlaceRepository */
    private $repository;

    /** @var HttpClientInterface */
    private $httpClient;

    /** @var ParameterBagInterface */
    private $parameterBag;

    public function __construct(PlaceRepository $placeRepository,
                                HttpClientInterface $httpClient,
                                ParameterBagInterface $parameterBag)
    {
        $this->repository = $placeRepository;
        $this->httpClient = $httpClient;
        $this->parameterBag = $parameterBag;
    }

    public function __invoke(ById $byId)
    {
        $point = $this->repository->find($byId->id);

        $distance = null;
        $directions = null;
        $duration = null;

        if (!empty($byId->startLat) && !empty($byId->startLong)) {
            $response = $this->httpClient->request('GET',
                sprintf('https://api.mapbox.com/directions/v5/mapbox/driving/%s,%s;%s,%s',
                    $point->getLongitude(),
                    $point->getLatitude(),
                    $byId->startLong,
                    $byId->startLat
                ),
                [
                    'query' => [
                        'access_token' => $this->parameterBag->get("GOOGLE_API_KEY"),
                        'steps' => 'true',
                        'overview' => 'full'
                    ]
                ]);

            $arrayResponse = $response->toArray();

            $directions = array_map(function ($step) {
                return $step['intersections'][0]['location'];
            }, $arrayResponse['routes'][0]['legs'][0]['steps']);

            $distance = $arrayResponse['routes'][0]['distance'];
            $duration = $arrayResponse['routes'][0]['duration'];
        }

        return new PlaceDTO(
            $point->getId(),
            $point->getName(),
            $point->getDescription(),
            $point->getPhotos(),
            $directions,
            $distance,
            $duration,
            $point->getLatitude(),
            $point->getLongitude()
        );
    }
}
