<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Lookup extends DataClass
{

    /**
     * Returns an earlier history if requested quarter does not have a club history.
     * 
     * @param integer $season_year
     * @param integer $season_quarter
     * @return mixed
     */
    public function club_history(int $season_year, int $season_quarter)
    {
        $params = [
            'season_year' => $season_year,
            'season_quarter' => $season_quarter
        ];
        return $this->api->request('/lookup/club_history', $params);
    }

    /**
     * @return mixed
     */
    public function countries()
    {
        return $this->api->request('/lookup/countries');
    }

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