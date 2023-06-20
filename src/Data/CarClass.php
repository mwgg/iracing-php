<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class CarClass extends DataClass
{

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->api->request('/carclass/get');
    }

}