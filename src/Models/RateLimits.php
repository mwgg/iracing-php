<?php

namespace iRacingPHP\Models;

class RateLimits
{
    public int $limit;
    public int $remaining;
    public int $reset;
}