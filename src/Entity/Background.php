<?php

namespace App\Entity;

use App\Repository\BackgroundRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BackgroundRepository::class)
 */
class Background
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $capacities;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_language;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacities(): ?string
    {
        return $this->capacities;
    }

    public function setCapacities(string $capacities): self
    {
        $this->capacities = $capacities;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbLanguage(): ?int
    {
        return $this->nb_language;
    }

    public function setNbLanguage(int $nb_language): self
    {
        $this->nb_language = $nb_language;

        return $this;
    }
}
