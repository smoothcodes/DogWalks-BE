<?php

namespace App\Handler\Command\User;

use App\Command\User\RegisterUser;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Utils\ApiErrorCodes;
use App\Utils\ApiStatuses;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterUserHandler implements MessageHandlerInterface
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserRepository $userRepository,
                                UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function __invoke(RegisterUser $registerUser)
    {
        try {
            $user = new User();
            $user
                ->setEmail($registerUser->email)
                ->setPassword($this->passwordEncoder->encodePassword($user, $registerUser->password))
                ->setRoles(['ROLE_USER']);

            $this->repository->save($user);

        } catch (UniqueConstraintViolationException $exception) {
            return [
                'code' => (string) ApiErrorCodes::NOT_UNIQUE_VALUE(),
                'status' => (string) ApiStatuses::ERROR()
            ];
        }

        return $user;
    }
}
