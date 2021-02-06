<?php

namespace App\Entity;

use App\Repository\MachineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MachineRepository::class)
 */
class Machine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=MachineType::class, inversedBy="machines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $modele;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_heure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?MachineType
    {
        return $this->type;
    }

    public function setType(?MachineType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getNbHeure(): ?int
    {
        return $this->nb_heure;
    }

    public function setNbHeure(int $nb_heure): self
    {
        $this->nb_heure = $nb_heure;

        return $this;
    }
}
