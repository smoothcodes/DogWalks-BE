<?php

namespace App\Controller\Rest;

use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractRestController extends AbstractFOSRestController {

    protected MessageBusInterface $messageBus;

    protected ValidatorInterface $validator;

    public function __construct(MessageBusInterface $messageBus,
                                ValidatorInterface $validator)
    {
        $this->messageBus = $messageBus;
        $this->validator = $validator;
    }

    public function paginatedResponse(PaginationInterface $pagination)
    {
        return [
            'items' => $pagination->getItems(),
            'current_page' => $pagination->getCurrentPageNumber(),
            'items_per_page' => $pagination->getItemNumberPerPage(),
            'total_items_count' => $pagination->getTotalItemCount()
        ];
    }

    public function createContext(array $groups)
    {
        $context = new Context();
        $context->setGroups($groups);

        return $context;
    }
}
