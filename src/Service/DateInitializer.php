<?php

namespace App\Service;

use DateTime;

class DateInitializer
{    
    /**
     * init date if not given as input, and return with correct format for github API call
     */
    public function initSinceDate(?string $since)
    {
        if ($since === null){
            $since = new DateTime();
            $since = $since->modify('-4 week');
            $since = $since->format('Y-m-d\TH:i:s');
        }

        return $since;
    }

    /**
     * init date if not given as input, and return with correct format for github API call
     */
    public function initUntilDate(?string $until)
    {
        if ($until === null){
            $until = new DateTime();
            $until = $until->format('Y-m-d\TH:i:s');
        }

        return $until;
    }
}