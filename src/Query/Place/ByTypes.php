<?php

namespace App\Query\Place;

use App\Query\Query;
use App\Repository\PlaceRepository;

class ByTypes implements Query {

    private $repository;

    public function __construct(PlaceRepository $placeRepository)
    {
        $this->repository = $placeRepository;
    }

    public function getResult($typesIds) {
        return $this->repository->createQueryBuilder('p')
            ->join('p.placeTypes', 'pt')
            ->where('pt.id IN (:ids)')
            ->setParameter('ids', $typesIds)
            ->getQuery()
            ->getResult();

    }
}
