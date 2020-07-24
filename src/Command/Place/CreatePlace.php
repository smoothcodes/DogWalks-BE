<?php

namespace App\Command\Place;

use JMS\Serializer\Annotation as JMS;

class CreatePlace
{
    /**
     * @JMS\Type("string")
     */
    public $name;

    /**
     * @JMS\Type("string")
     */
    public $description;

    /**
     * @JMS\Type("array<string>")
     */
    public $photos;

    /**
     * @JMS\Type("double")
     */
    public $longitude;

    /**
     * @JMS\Type("double")
     */
    public $latitude;

    /**
     * @JMS\Type("array<int>")
     */
    public $types;
}
