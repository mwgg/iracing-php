<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Team extends DataClass
{
    /**
     * @param integer $team_id 
     * @param boolean ['include_licenses'] For faster responses, only request when necessary.
     * @return mixed
     */
    public function get(int $team_id, array $params = [])
    {
        $params['team_id'] = $team_id;
        return $this->api->request('/stats/member_career', $params);
    }
}