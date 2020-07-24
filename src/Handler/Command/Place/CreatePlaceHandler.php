<?php

namespace App\Handler\Command\Place;

use App\Command\Place\CreatePlace;
use App\Entity\Place;
use App\Entity\PlacePhoto;
use App\Repository\PlaceRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreatePlaceHandler implements MessageHandlerInterface
{
    private $repository;

    public function __construct(PlaceRepository $placeRepository)
    {
        $this->repository = $placeRepository;
    }

    public function __invoke(CreatePlace $createPlace)
    {
        $place = new Place();

        $place->setLongitude($createPlace->longitude)
            ->setLatitude($createPlace->latitude)
            ->setName($createPlace->name)
            ->setDescription($createPlace->description);

        foreach ($createPlace->photos as $photo) {
            $photoEntity = new PlacePhoto();
            $photoEntity->setContent($photo);
            $photoEntity->setPlace($place);
            $place->addPhoto($photoEntity);
        }

        foreach ($createPlace->types as $type) {
            $place->addPlaceType($this->repository->getTypeReference($type));
        }

        $this->repository->save($place);

        return $place;
    }
}
