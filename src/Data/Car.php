<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Car extends DataClass
{

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->api->request('/car/get');
    }

    /**
     * image paths are relative to https://images-static.iracing.com/
     * 
     * @return mixed
     */
    public function assets()
    {
        return $this->api->request('/car/assets');
    }

}