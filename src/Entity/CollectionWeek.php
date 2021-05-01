<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Ignore;

class CollectionWeek
{
    /**
     * @Ignore()
     */
    private int $id;

    private int $year;

    private int $week;

    private int $count;

    /**
     * @var array<array>
     */
    private array $commits = [];
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function setWeek(int $week): self
    {
        $this->week = $week;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return array<array>
     */
    public function getCommits(): ?array
    {
        return $this->commits;
    }

    /**
     * @param array<array> $commits
     */
    public function setCommits(array $commits): self
    {
        $this->commits = $commits;

        return $this;
    }
}
