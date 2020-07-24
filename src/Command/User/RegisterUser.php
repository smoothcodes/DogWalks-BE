<?php

namespace App\Command\User;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @JMS\Type("string")
     */
    public $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="#^(?=.*[0-9])(?=.*[A-Z]).{8,20}$#")
     * @JMS\Type("string")
     */
    public $password;
}
