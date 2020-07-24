<?php

namespace App\Controller\Rest;

use App\Repository\PlaceTypeRepository;
use FOS\RestBundle\Controller\Annotations as Rest;


class PlaceTypeController extends AbstractRestController
{
    /**
     * @Rest\Get("/place_types", name="rest_get_place_types")
     */
    public function all(PlaceTypeRepository $repository)
    {
        return $this->handleView(
            $this->view($repository->findAll(), 200)
        );
    }
}
