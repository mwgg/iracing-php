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

    /**
     * @param string ['from'] ISO-8601 offset format. Defaults to the current time. Include sessions with start times up to 3 hours after this time. Times in the past will be rewritten to the current time.
     * @param boolean ['include_end_after_from'] Include sessions which start before 'from' but end after.
     * @return mixed
     */
    public function race_guide(array $params = [])
    {
        return $this->api->request('/season/race_guide', $params);
    }

}