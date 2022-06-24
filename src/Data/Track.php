<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Track extends DataClass
{
    /**
     * @return mixed
     */
    public function get()
    {
        return $this->api->request('/track/get');
    }

    /**
     * image paths are relative to https://images-static.iracing.com/
     *
     * @return mixed
     */
    public function assets()
    {
        return $this->api->request('/track/assets');
    }

}