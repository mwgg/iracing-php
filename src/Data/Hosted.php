<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Hosted extends DataClass
{

    /**
     * Sessions that can be joined as a driver or spectator, and also includes non-league pending sessions for the user.
     * 
     * @param integer ['package_id'] If set, return only sessions using this car or track package ID.
     * @return mixed
     */
    public function combined_sessions(array $params = [])
    {
        return $this->api->request('/hosted/combined_sessions', $params);
    }

    /**
     * Sessions that can be joined as a driver. Without spectator and non-league pending sessions for the user.
     *
     * @return mixed
     */
    public function sessions()
    {
        return $this->api->request('/hosted/sessions');
    }

}
