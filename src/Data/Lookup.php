<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Lookup extends DataClass
{

    /**
     * weather=weather_wind_speed_units
     * weather=weather_wind_speed_max
     * weather=weather_wind_speed_min
     * licenselevels=licenselevels
     * 
     * @return mixed
     */
    public function get(array $params = [])
    {
        return $this->api->request('/lookup/get', $params);
    }

    /**
     * @return mixed
     */
    public function licenses()
    {
        return $this->api->request('/lookup/licenses');
    }

}