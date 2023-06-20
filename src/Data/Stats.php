<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Stats extends DataClass
{

    /**
     * @param integer ['cust_id'] Defaults to the authenticated member.
     * @param integer ['car_id'] First call should exclude car_id; use cars_driven list in return for subsequent calls.
     * @return mixed
     */
    public function member_bests(array $params = [])
    {
        return $this->api->request('/stats/member_bests', $params);
    }

    /**
     * @param integer ['cust_id'] Defaults to the authenticated member.
     * @return mixed
     */
    public function member_career(array $params = [])
    {
        return $this->api->request('/stats/member_career', $params);
    }

    /**
     * Divisions are 0-based: 0 is Division 1, 10 is Rookie. See /data/constants/divisons for more information. Always for the authenticated member.
     * 
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
     * @param integer ['year'] Season year; if not supplied the current calendar year (UTC) is used.
     * @param integer ['season'] Season (quarter) within the year; if not supplied the recap will be fore the entire year.
     * @return mixed
     */
    public function member_recap(array $params = [])
    {
        return $this->api->request('/stats/member_recap', $params);
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
     * @param integer ['club_id'] Defaults to all (-1).
     * @param integer ['division'] Divisions are 0-based: 0 is Division 1, 10 is Rookie. See /data/constants/divisons for more information. Defaults to all.
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
     * @param integer ['club_id'] Defaults to all (-1).
     * @param integer ['division'] Divisions are 0-based: 0 is Division 1, 10 is Rookie. See /data/constants/divisons for more information. Defaults to all.
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
     * @param integer ['club_id'] Defaults to all (-1).
     * @param integer ['division'] Divisions are 0-based: 0 is Division 1, 10 is Rookie. See /data/constants/divisons for more information. Defaults to all.
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
     * @param integer ['club_id'] Defaults to all (-1).
     * @param integer ['division'] Divisions are 0-based: 0 is Division 1, 10 is Rookie. See /data/constants/divisons for more information. Defaults to all.
     * @return mixed
     */
    public function season_tt_results(int $season_id, int $car_class_id, int $race_week_num, array $params = [])
    {
        $params['season_id'] = $season_id;
        $params['car_class_id'] = $car_class_id;
        $params['race_week_num'] = $race_week_num;
        return $this->api->request('/stats/season_tt_results', $params);
    }

    /**
     * @param integer $season_id
     * @param integer $car_class_id
     * @param integer $race_week_num The first race week of a season is 0.
     * @param integer ['club_id'] Defaults to all (-1).
     * @param integer ['division'] Divisions are 0-based: 0 is Division 1, 10 is Rookie. See /data/constants/divisons for more information. Defaults to all.
     * @return mixed
     */
    public function season_qualify_results(int $season_id, int $car_class_id, int $race_week_num, array $params = [])
    {
        $params['season_id'] = $season_id;
        $params['car_class_id'] = $car_class_id;
        $params['race_week_num'] = $race_week_num;
        return $this->api->request('/stats/season_qualify_results', $params);
    }

    /**
     * @param integer $car_id
     * @param integer $track_id
     * @param integer ['season_year'] Limit best times to a given year.
     * @param integer ['season_quarter'] Limit best times to a given quarter; only applicable when year is used.
     * @return mixed
     */
    public function world_records(int $car_id, int $track_id, array $params = [])
    {
        $params['car_id'] = $car_id;
        $params['track_id'] = $track_id;
        return $this->api->request('/stats/world_records', $params);
    }

}