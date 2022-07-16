<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Season extends DataClass
{

    /**
     * @param integer $season_year
     * @param integer $season_quarter
     * @return mixed
     */
    public function list(int $season_year, int $season_quarter)
    {
        $params = [
            'season_year' => $season_year,
            'season_quarter' => $season_quarter
        ];
        return $this->api->request('/season/list', $params);
    }
}