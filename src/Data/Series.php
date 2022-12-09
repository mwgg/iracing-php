<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Series extends DataClass
{
    /**
     * image paths are relative to https://images-static.iracing.com/
     *
     * @return mixed
     */
    public function assets()
    {
        return $this->api->request('/series/assets');
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->api->request('/series/get');
    }

    /**
     * @param integer $series_id
     *
     * @return mixed
     */
    public function past_sessions(int $series_id)
    {
        $params = [
            'series_id' => $series_id
        ];
        return $this->api->request('/series/past_sessions', $params);
    }

    /**
     * @param boolean ['include_series']
     *
     * @return mixed
     */
    public function seasons(array $params = [])
    {
        return $this->api->request('/series/seasons', $params);
    }

    /**
     * To get series and seasons for which standings should be available, filter the list by official: true.
     *
     * @return mixed
     */
    public function stats_series()
    {
        return $this->api->request('/series/stats_series');
    }
}