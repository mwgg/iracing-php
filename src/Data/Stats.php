<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Stats extends DataClass
{
    /**
     * @param integer ['cust_id'] Defaults to the authenticated member.
     * @return mixed
     */
    public function member_career(array $params = [])
    {
        return $this->api->request('/stats/member_career', $params);
    }

    /**
     * @param integer $season_id
     * @param integer $event_type The event type code for the division type: 4 - Time Trial; 5 - Race
     * @return mixed
     */
    public function member_division(int $season_id, int $event_type)
    {
        $params = array(
            'season_id' => $season_id,
            'event_type' => $event_type
        );
        return $this->api->request('/stats/member_division', $params);
    }

    /**
     * @param integer ['cust_id'] Defaults to the authenticated member.
     * @return mixed
     */
    public function member_recent_races(array $params = [])
    {
        return $this->api->request('/stats/member_recent_races', $params);
    }

    /**
     * @param integer ['cust_id'] Defaults to the authenticated member.
     * @return mixed
     */
    public function member_summary(array $params = [])
    {
        return $this->api->request('/stats/member_summary', $params);
    }

    /**
     * @param integer ['cust_id'] Defaults to the authenticated member.
     * @return mixed
     */
    public function member_yearly(array $params = [])
    {
        return $this->api->request('/stats/member_yearly', $params);
    }

    /**
     * @param integer $season_id
     * @param integer $car_class_id
     * @param integer ['race_week_num'] The first race week of a season is 0.
     * @return mixed
     */
    public function season_driver_standings(int $season_id, int $car_class_id, array $params = [])
    {
        $params['season_id'] = $season_id;
        $params['car_class_id'] = $car_class_id;
        return $this->api->request('/stats/season_driver_standings', $params);
    }

    /**
     * @param integer $season_id
     * @param integer $car_class_id
     * @param integer ['race_week_num'] The first race week of a season is 0.
     * @return mixed
     */
    public function season_supersession_standings(int $season_id, int $car_class_id, array $params = [])
    {
        $params['season_id'] = $season_id;
        $params['car_class_id'] = $car_class_id;
        return $this->api->request('/stats/season_supersession_standings', $params);
    }

    /**
     * @param integer $season_id
     * @param integer $car_class_id
     * @param integer ['race_week_num'] The first race week of a season is 0.
     * @return mixed
     */
    public function season_team_standings(int $season_id, int $car_class_id, array $params = [])
    {
        $params['season_id'] = $season_id;
        $params['car_class_id'] = $car_class_id;
        return $this->api->request('/stats/season_team_standings', $params);
    }

    /**
     * @param integer $season_id
     * @param integer $car_class_id
     * @param integer ['race_week_num'] The first race week of a season is 0.
     * @return mixed
     */
    public function season_tt_standings(int $season_id, int $car_class_id, array $params = [])
    {
        $params['season_id'] = $season_id;
        $params['car_class_id'] = $car_class_id;
        return $this->api->request('/stats/season_tt_standings', $params);
    }

    /**
     * @param integer $season_id
     * @param integer $car_class_id
     * @param integer $race_week_num The first race week of a season is 0.
     * @return mixed
     */
    public function season_tt_results(int $season_id, int $car_class_id, int $race_week_num)
    {
        $params = array(
            'season_id' => $season_id,
            'car_class_id' => $season_id,
            'race_week_num' => $race_week_num
        );
        return $this->api->request('/stats/season_tt_results', $params);
    }

    /**
     * @param integer $season_id
     * @param integer $car_class_id
     * @param integer $race_week_num The first race week of a season is 0.
     * @return mixed
     */
    public function season_qualify_results(int $season_id, int $car_class_id, int $race_week_num)
    {
        $params = array(
            'season_id' => $season_id,
            'car_class_id' => $season_id,
            'race_week_num' => $race_week_num
        );
        return $this->api->request('/stats/season_qualify_results', $params);
    }
}