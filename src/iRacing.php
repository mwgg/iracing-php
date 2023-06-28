<?php

namespace iRacingPHP;

use iRacingPHP\Data\Car;
use iRacingPHP\Data\CarClass;
use iRacingPHP\Data\Constants;
use iRacingPHP\Data\Hosted;
use iRacingPHP\Data\League;
use iRacingPHP\Data\Lookup;
use iRacingPHP\Data\Member;
use iRacingPHP\Data\Results;
use iRacingPHP\Data\Season;
use iRacingPHP\Data\Series;
use iRacingPHP\Data\Stats;
use iRacingPHP\Data\Team;
use iRacingPHP\Data\TimeAttack;
use iRacingPHP\Data\Track;
use iRacingPHP\Exceptions\ApiServiceNotFoundException;

class iRacing
{
    public Api $api;
    public Car $car;
    public CarClass $carclass;
    public Constants $constants;
    public Hosted $hosted;
    public League $league;
    public Lookup $lookup;
    public Member $member;
    public Results $results;
    public Season $season;
    public Series $series;
    public Stats $stats;
    public Team $team;
    public Track $track;
    public TimeAttack $time_attack;
    
    function __construct(string $username, string $password, $cookiejar = LibConstants::COOKIEJAR)
    {
        $this->api = new Api($username, $password, $cookiejar);

        $this->car = new Car($this->api);
        $this->carclass = new CarClass($this->api);
        $this->constants = new Constants($this->api);
        $this->hosted = new Hosted($this->api);
        $this->league = new League($this->api);
        $this->lookup = new Lookup($this->api);
        $this->member = new Member($this->api);
        $this->results = new Results($this->api);
        $this->season = new Season($this->api);
        $this->series = new Series($this->api);
        $this->team = new Team($this->api);
        $this->track = new Track($this->api);
        $this->stats = new Stats($this->api);
        $this->time_attack = new TimeAttack($this->api);
    }
}