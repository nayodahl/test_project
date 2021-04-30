<?php

namespace App\Entity;

use App\Repository\CollectionWeekRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollectionWeekRepository::class)
 */
class CollectionWeek
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $week;

    /**
     * @ORM\Column(type="integer")
     */
    private $count;

    /**
     * @ORM\Column(type="array")
     */
    private $commits = [];

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

    public function getCommits(): ?array
    {
        return $this->commits;
    }

    public function setCommits(array $commits): self
    {
        $this->commits = $commits;

        return $this;
    }
}
