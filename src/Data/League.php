<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class League extends DataClass
{
    /**
     * @param bool ['mine'] If true, return only sessions created by this user.
     * @param int ['package_id'] If set, return only sessions using this car or track package ID.
     * 
     * @return mixed
     */
    public function cust_league_sessions(array $params = [])
    {
        return $this->api->request('/league/cust_league_sessions', $params);
    }

    /**
     * @param string ['search'] Will search against league name, description, owner, and league ID.
     * @param string ['tag'] One or more tags, comma-separated.
     * @param bool ['restrict_to_member'] If true include only leagues for which customer is a member.
     * @param bool ['restrict_to_recruiting'] If true include only leagues which are recruiting.
     * @param bool ['restrict_to_friends'] If true include only leagues owned by a friend.
     * @param bool ['restrict_to_watched'] If true include only leagues owned by a watched member.
     * @param int ['minimum_roster_count'] If set include leagues with at least this number of members.
     * @param int ['maximum_roster_count'] If set include leagues with no more than this number of members.
     * @param int ['lowerbound'] First row of results to return.  Defaults to 1.
     * @param int ['upperbound'] Last row of results to return. Defaults to lowerbound + 39.
     * @param string ['sort'] One of relevance, leaguename, displayname, rostercount. displayname is owners's name. Defaults to relevance.
     * @param string ['order'] One of asc or desc. Defaults to asc.
     * 
     * @return mixed
     */
    public function directory(array $params = [])
    {
        return $this->api->request('/league/directory', $params);
    }
    
    /**
     * @param integer $league_id
     * @param boolean ['include_licenses'] For faster responses, only request when necessary.
     * @return mixed
     */
    public function get(int $league_id, array $params = [])
    {
        $params['league_id'] = $league_id;
        return $this->api->request('/league/get', $params);
    }

    /**
     * @param integer $league_id
     * @param integer ['season_id'] If included and the season is using custom points (points_system_id:2) then the custom points option is included in the returned list. Otherwise the custom points option is not returned.
     * @return mixed
     */
    public function get_points_systems(int $league_id, array $params = [])
    {
        $params['league_id'] = $league_id;
        return $this->api->request('/league/get_points_systems', $params);
    }

    /**
     * @param integer ['cust_id'] If different from the authenticated member, the following resrictions apply: - Caller cannot be on requested customer's block list or an empty list will result; - Requested customer cannot have their online activity prefrence set to hidden or an empty list will result; - Only leagues for which the requested customer is an admin and the league roster is not private are returned.
     * @param boolean ['include_league']
     * @return mixed
     */
    public function membership(array $params = [])
    {
        return $this->api->request('/league/membership', $params);
    }

    /**
     * @param integer $league_id
     * @param boolean ['retired'] If true include seasons which are no longer active.
     * @return mixed
     */
    public function seasons(int $league_id, array $params = [])
    {
        $params['league_id'] = $league_id;
        return $this->api->request('/league/seasons', $params);
    }

    /**
     * @param integer $league_id
     * @param integer $season_id
     * @param integer ['car_class_id']
     * @param integer ['car_id'] If car_class_id is included then the standings are for the car in that car class, otherwise they are for the car across car classes.
     * @param boolean ['results_only'] If true include only sessions for which results are available.
     * @return mixed
     */
    public function season_standings(int $league_id, int $season_id, array $params = [])
    {
        $params['league_id'] = $league_id;
        $params['season_id'] = $season_id;
        return $this->api->request('/league/season_standings', $params);
    }

    /**
     * @param integer $league_id
     * @param integer $season_id
     * @param boolean ['results_only'] If true include only sessions for which results are available.
     * @return mixed
     */
    public function season_sessions(int $league_id, int $season_id, array $params = [])
    {
        $params['league_id'] = $league_id;
        $params['season_id'] = $season_id;
        return $this->api->request('/league/season_sessions', $params);
    }

}