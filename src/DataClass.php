<?php

namespace iRacingPHP;

class DataClass
{
    protected Api $api;

    function __construct(Api $api)
    {
        $this->api = $api;
    }

}