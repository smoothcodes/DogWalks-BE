<?php

namespace App\Query\Place;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\Collection;

class ByBoundaries {

    private $repository;

    public function __construct(PlaceRepository $placeRepository)
    {
        $this->repository = $placeRepository;
    }

    public function getResult($longFrom, $longTo, $latFrom, $latTo): array
    {
        return $this->repository
            ->createQueryBuilder('p')
            ->where('p.longitude BETWEEN :longFrom AND :longTo')
            ->andWhere('p.latitude BETWEEN :latFrom AND :latTo')
            ->setParameters([
                'longFrom' => $longFrom,
                'longTo' => $longTo,
                'latFrom' => $latFrom,
                'latTo' => $latTo
            ])
            ->getQuery()
            ->getResult();
    }
}
