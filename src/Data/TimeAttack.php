<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class TimeAttack extends DataClass
{
    /**
     * Results for the authenticated member, if any.
     * 
     * @param integer $ta_comp_season_id
     * @return mixed
     */
    public function member_season_results(int $ta_comp_season_id)
    {
        $params = array(
            'ta_comp_season_id' => $ta_comp_season_id,
        );
        return $this->api->request('/time_attack/member_season_results', $params);
    }
}