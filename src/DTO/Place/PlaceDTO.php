<?php

namespace App\DTO\Place;
use JMS\Serializer\Annotation as JMS;

/**
 * Class PlaceDTO
 * @package App\DTO\Place
 *
 * @JMS\ExclusionPolicy("all")
 */
class PlaceDTO
{
    /**
     * @JMS\Expose()
     * @JMS\Type("string")
     */
    public $id;

    /**
     * @JMS\Expose()
     *
     */
    public $name;

    /**
     * @JMS\Expose()
     * @JMS\Type("string")
     *
     */
    public $description;

    /**
     * @JMS\Expose()
     *
     */
    public $photos;

    /**
     * @JMS\Expose()
     */
    public $directions;

    /**
     * @JMS\Expose()
     */
    public $distance;

    /**
     * @JMS\Expose()
     */
    public $duration;

    /**
     * @JMS\Expose()
     */
    public $latitude;

    /**
     * @JMS\Expose()
     */
    public $longitude;

    /**
     * PlaceDTO constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $photos
     * @param $directions
     * @param $distance
     * @param $duration
     */
    public function __construct($id, $name, $description, $photos, $directions, $distance, $duration, $latitude, $longitude)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->photos = $photos;
        $this->directions = $directions;
        $this->distance = $distance;
        $this->duration = $duration;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

}
