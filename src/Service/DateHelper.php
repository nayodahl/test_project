<?php

namespace App\Service;

use DateTime;

class DateHelper
{
    const DATEFORMAT = 'Y-m-d\TH:i:s';
    
    /**
     * init date if not given as input
     */
    public function initSinceDate(?string $since): DateTime
    {
        if ($since === null) {
            $since = new DateTime();
            
            return $since->modify('-4 week');
        }

        return DateTime::createFromFormat(self::DATEFORMAT, $since);
    }

    /**
     * init date if not given as input
     */
    public function initUntilDate(?string $until): DateTime
    {
        if ($until === null) {
            return new DateTime();
        }

        return DateTime::createFromFormat(self::DATEFORMAT, $until);
    }

    /**
     * return formated datetime, used to consome github API
     */
    public function formatDate(DateTime $date): string
    {
        return $date->format(self::DATEFORMAT);
    }

    /**
     * return number of weeks between 2 datetime objects
     */
    public function countNumberOfWeeksBetweenDates(DateTime $since, DateTime $until): int
    {
        $interval = $until->diff($since);
        $formatedInterval = $interval->format('%a');
        $value = $formatedInterval / 7;

        return intval(ceil($value));
    }
}
