<?php

namespace iRacingPHP\Data;

use iRacingPHP\DataClass;

class Constants extends DataClass
{

    /**
     * @return array
     */
    public function categories()
    {
        return [
            1 => 'Oval',
            2 => 'Road',
            3 => 'Dirt oval',
            4 => 'Dirt road'
        ];
    }
    
    /**
     * @return array
     */
    public function divisions()
    {
        return [
            -1 => 'ALL',
            0 => 'Division 1',
            1 => 'Division 2',
            2 => 'Division 3',
            3 => 'Division 4',
            4 => 'Division 5',
            5 => 'Division 6',
            6 => 'Division 7',
            7 => 'Division 8',
            8 => 'Division 9',
            9 => 'Division 10',
            10 => 'Rookie'
        ];
    }

    /**
     * @return array
     */
    public function event_types()
    {
        return [
            2 => 'Practice',
            3 => 'Qualify',
            4 => 'Time Trial',
            5 => 'Race'
        ];
    }

}