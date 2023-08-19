<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Results extends DataClass
{

    /**
     * Get the results of a subsession, if authorized to view them. series_logo image paths are relative to https://images-static.iracing.com/img/logos/series/
     * 
     * @param integer $subsession_id
     * @param boolean ['include_licenses']
     * @return mixed
     */
    public function get(int $subsession_id, array $params = [])
    {
        $params['subsession_id'] = $subsession_id;
        return $this->api->request('/results/get', $params);
    }

    /**
     * @param integer $subsession_id
     * @param integer $simsession_number The main event is 0; the preceding event is -1, and so on.
     * @return mixed
     */
    public function event_log(int $subsession_id, int $simsession_number)
    {
        $params = [
            'subsession_id' => $subsession_id,
            'simsession_number' => $simsession_number
        ];
        return $this->api->request('/results/event_log', $params);
    }

    /**
     * @param integer $subsession_id
     * @param integer $simsession_number The main event is 0; the preceding event is -1, and so on.
     * @return mixed
     */
    public function lap_chart_data(int $subsession_id, int $simsession_number)
    {
        $params = [
            'subsession_id' => $subsession_id,
            'simsession_number' => $simsession_number
        ];
        return $this->api->request('/results/lap_chart_data', $params);
    }

    /**
     * @param integer $subsession_id
     * @param integer $simsession_number The main event is 0; the preceding event is -1, and so on.
     * @param integer ['cust_id'] Required if the subsession was a single-driver event. Optional for team events. If omitted for a team event then the laps driven by all the team's drivers will be included.
     * @param integer ['team_id'] Required if the subsession was a team event.
     * @return mixed
     */
    public function lap_data(int $subsession_id, int $simsession_number, array $params = [])
    {
        $params['subsession_id'] = $subsession_id;
        $params['simsession_number'] = $simsession_number;
        return $this->api->request('/results/lap_data', $params);
    }

    /**
     * Hosted and league sessions. Maximum time frame of 90 days. Results split into one or more files with chunks of results.
     * For scraping results the most effective approach is to keep track of the maximum end_time found during a search
     * then make the subsequent call using that date/time as the finish_range_begin and skip any subsessions that are duplicated.
     * Results are ordered by subsessionid which is a proxy for start time. Requires one of: start_range_begin, finish_range_begin.
     * Requires one of: cust_id, host_cust_id, session_name.
     *
     * @param string ['start_range_begin'] Session start times. ISO-8601 UTC time zero offset: "2022-04-01T15:45Z".
     * @param string ['start_range_end'] ISO-8601 UTC time zero offset: "2022-04-01T15:45Z". Exclusive. May be omitted if start_range_begin is less than 90 days in the past.
     * @param string ['finish_range_begin'] Session finish times. ISO-8601 UTC time zero offset: "2022-04-01T15:45Z".
     * @param string ['finish_range_end'] ISO-8601 UTC time zero offset: "2022-04-01T15:45Z". Exclusive. May be omitted if finish_range_begin is less than 90 days in the past.
     * @param integer ['cust_id'] The participant's customer ID.
     * @param integer ['team_id'] The team ID to search for. Takes priority over cust_id if both are supplied.
     * @param integer ['host_cust_id'] The host's customer ID.
     * @param string ['session_name'] Part or all of the session's name.
     * @param integer ['league_id'] Include only results for the league with this ID.
     * @param integer ['league_season_id'] Include only results for the league season with this ID.
     * @param integer ['car_id'] One of the cars used by the session.
     * @param integer ['track_id'] The ID of the track used by the session.
     * @param string ['category_ids'] Track categories to include in the search. Defaults to all. [Comma-separated numbers]
     * @return mixed
     */
    public function search_hosted(array $params = [])
    {
        return $this->api->request('/results/search_hosted', $params);
    }
 
    /**
     * Official series. Maximum time frame of 90 days. Results split into one or more files with chunks of results.
     * For scraping results the most effective approach is to keep track of the maximum end_time found during a search
     * then make the subsequent call using that date/time as the finish_range_begin and skip any subsessions that are duplicated.
     * Results are ordered by subsessionid which is a proxy for start time but groups together multiple splits of a series when
     * multiple series launch sessions at the same time.
     * Requires at least one of: season_year and season_quarter, start_range_begin, finish_range_begin.
     * 
     * @param integer ['season_year'] Required when using season_quarter.
     * @param integer ['season_quarter'] Required when using season_year.
     * @param string ['start_range_begin'] Session start times. ISO-8601 UTC time zero offset: "2022-04-01T15:45Z".
     * @param string ['start_range_end'] ISO-8601 UTC time zero offset: "2022-04-01T15:45Z". Exclusive. May be omitted if start_range_begin is less than 90 days in the past.
     * @param string ['finish_range_begin'] Session finish times. ISO-8601 UTC time zero offset: "2022-04-01T15:45Z".
     * @param string ['finish_range_end'] ISO-8601 UTC time zero offset: "2022-04-01T15:45Z". Exclusive. May be omitted if finish_range_begin is less than 90 days in the past.
     * @param integer ['cust_id'] Include only sessions in which this customer participated.
     * @param integer ['team_id'] Include only sessions in which this team participated. Takes priority over cust_id if both are supplied.
     * @param integer ['series_id'] Include only sessions for series with this ID.
     * @param integer ['race_week_num'] Include only sessions with this race week number.
     * @param boolean ['official_only'] If true, include only sessions earning championship points. Defaults to all.
     * @param string ['event_types'] Types of events to include in the search. Defaults to all. [Comma-separated numbers]
     * @param string ['category_ids'] License categories to include in the search. Defaults to all. [Comma-separated numbers]
     * @return mixed
     */
    public function search_series(array $params = [])
    {
        return $this->api->request('/results/search_series', $params);
    }

    /**
     * @param integer $season_id
     * @param integer ['event_type'] Retrict to one event type: 2 - Practice; 3 - Qualify; 4 - Time Trial; 5 - Race
     * @param integer ['race_week_num'] The first race week of a season is 0.
     * @return mixed
     */
    public function season_results(int $season_id, array $params = [])
    {
        $params['season_id'] = $season_id;
        $results = $this->api->request('/results/season_results', $params);

        return $results;
    }

}