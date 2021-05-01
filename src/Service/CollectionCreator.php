<?php

namespace App\Service;

use App\Entity\CollectionWeek;

class CollectionCreator
{
    private DateHelper $dateHelper;
    private GithubAPICaller $githubAPICaller;

    public function __construct(DateHelper $dateHelper, GithubAPICaller $githubAPICaller)
    {
        $this->dateHelper = $dateHelper;
        $this->githubAPICaller = $githubAPICaller;
    }
    
    /**
     * Returns an array of CollectionWeek, each line of this array represents a week.
     * A CollectionWeek contains an array of all commits of a user on a given repository, plus additional infos
     * @return array<int, CollectionWeek>
     */
    public function getCommitsCollection(string $user, string $repository, ?string $since, ?string $until): array
    {
        $since = $this->dateHelper->initSinceDate($since);
        $until = $this->dateHelper->initUntilDate($until);
        $numberOfWeeksBetweenDates = $this->dateHelper->countNumberOfWeeksBetweenDates($since, $until);
        $result = array();

        // we iterate through $numberOfWeeksBetweenDates and build a CollectionWeek object on each loop
        for ($i=0; $i < $numberOfWeeksBetweenDates; $i++) {
            $j=$i;
            $k=$j+1;
            $weekStart = clone $since;
            $weekEnd = clone $since;

            // first we have to define date limits for this CollectionWeek
            while ($j > 0) {
                $weekStart->modify('+7 day');
                $j--;
            }

            while ($k > 0) {
                $weekEnd->modify('+7 day');
                $k--;
            }

            // if where are in the last iteration of this for loop, we override $weekend to be equal to the origal $until value
            if ($i === ($numberOfWeeksBetweenDates - 1)){
                $weekEnd = clone $until;
            }

            // now that date limits are set, we can make the call to GithubAPI
            $commits = $this->githubAPICaller->getCommitsFromApi(
                $user,
                $repository,
                $this->dateHelper->formatDate($weekStart),
                $this->dateHelper->formatDate($weekEnd)
            );

            // lastly, we can create our CollectionWeek object and define its properties
            $collection = new CollectionWeek();
            $collection->setCommits($commits);
            $collection->setYear(intval($weekStart->format('Y')));
            $collection->setWeek(intval($weekStart->format('W')));
            $collection->setCount(count($commits));

            array_push($result, $collection);
        }
        
        return $result;
    }
}
