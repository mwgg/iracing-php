<?php

namespace iRacingPHP;

use iRacingPHP\Exceptions\ApiServiceNotFoundException;

class iRacing
{
    public Api $api;
    
    function __construct(string $username, string $password, $cookiejar = LibConstants::COOKIEJAR)
    {
        $this->username = $username;
        $this->api = new Api($username, $password, $cookiejar);
    }

    /**
     * Dynamically (and magically) retrieves the appropriate service Data class.
     *
     * @param string $service
     * @return mixed
     */
    public function __get(string $service)
    {
        $service = 'iRacingPHP\\Data\\' . ucfirst($service);

        if (class_exists($service)) {
            $this->$service = new $service($this->api);

            return $this->$service;
        }
        else {
            throw new ApiServiceNotFoundException($service . " is not a valid API service");
        }
    }
}