<?php

namespace App\Controller\Rest;

use App\Command\Place\CreatePlace;
use App\Query\Place\ByBoundaries;
use App\Query\Place\ById;
use App\Query\Place\ByTypes;
use App\Repository\PlaceRepository;
use FOS\RestBundle\Context\Context;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

class PlaceController extends AbstractRestController
{
    /**
     * @Rest\Get("/place", name="rest_place")
     *
     */
    public function allPlaces(Request $request, ByTypes $byTypes, PlaceRepository $placeRepository)
    {
        $types = $request->get('types');
        if (is_array($types) && count($types) > 0) {
            $view = $this->view($byTypes->getResult($types), 200);
        } else {
            $view = $this->view($placeRepository->findAll(), 200);
        }
        $view->setContext($this->createContext(['all']));

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/place/{id}", name="rest_single_place")
     */
    public function place($id, Request $request)
    {
        $byId = new ById(
            $id,
            $request->query->get('startLat'),
            $request->query->get('startLong')
        );

        $envelope = $this->messageBus->dispatch($byId);
        $view = $this->view($envelope->last(HandledStamp::class)->getResult());
        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/place", name="rest_create_place")
     * @ParamConverter("createPlace", converter="fos_rest.request_body")
     */
    public function create(CreatePlace $createPlace)
    {
        $envelope = $this->messageBus->dispatch($createPlace);
        $view = $this->view($envelope->last(HandledStamp::class)->getResult(), 201);
        return $this->handleView($view);
    }
}
