<?php

namespace App\Controller\Rest;

use App\Command\User\RegisterUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

class UserController extends AbstractRestController
{
    /**
     * @Rest\Post("/user")
     * @ParamConverter("registerUser", converter="fos_rest.request_body")
     *
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     */
    public function create(RegisterUser $registerUser)
    {
        $errors = $this->validator->validate($registerUser);

        if (count($errors)) {
            return $this->handleView(
                $this->view($errors, 400)
            );
        }

        $envelope = $this->messageBus->dispatch($registerUser);
        $res = $envelope->last(HandledStamp::class)->getResult();

        return $this->handleView(
            $this->view($res, 201)
        );
    }
}
