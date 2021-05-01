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

        for ($i=0; $i < $numberOfWeeksBetweenDates; $i++) {
            $j=$i;
            $k=$j+1;
            $weekStart = clone $since;
            $weekEnd = clone $since;

            while ($j > 0) {
                $weekStart->modify('+7 day');
                $j--;
            }

            while ($k > 0) {
                $weekEnd->modify('+7 day');
                $k--;
            }

            $commits = $this->githubAPICaller->getCommitsFromApi(
                $user,
                $repository,
                $this->dateHelper->formatDate($weekStart),
                $this->dateHelper->formatDate($weekEnd)
            );

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
