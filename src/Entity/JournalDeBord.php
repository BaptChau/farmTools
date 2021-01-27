<?php

namespace App\Entity;

use App\Repository\JournalDeBordRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JournalDeBordRepository::class)
 */
class JournalDeBord
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $coprs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCoprs(): ?string
    {
        return $this->coprs;
    }

    public function setCoprs(string $coprs): self
    {
        $this->coprs = $coprs;

        return $this;
    }
}
