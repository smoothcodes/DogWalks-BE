<?php

namespace App\Query\Place;

class ById
{
    public $id;

    public $startLat;

    public $startLong;

    /**
     * ById constructor.
     * @param $id
     * @param $startLat
     * @param $startLong
     */
    public function __construct($id, $startLat, $startLong)
    {
        $this->id = $id;
        $this->startLat = $startLat;
        $this->startLong = $startLong;
    }


}
