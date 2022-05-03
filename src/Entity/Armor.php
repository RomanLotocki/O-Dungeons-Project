<?php

namespace App\Entity;

use App\Repository\ArmorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArmorRepository::class)
 */
class Armor
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
     * @ORM\Column(type="string", length=255)
     */
    private $armorType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $armorClass;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $strength;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $discretion;

    /**
     * @ORM\Column(type="float", options={"default": 0})
     */
    private $weight;

    /**
     * @ORM\ManyToMany(targetEntity=PlayableClass::class, mappedBy="armors")
     */
    private $playableClasses;

    public function __construct()
    {
        $this->playableClasses = new ArrayCollection();
    }

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

    public function getArmorType(): ?string
    {
        return $this->armorType;
    }

    public function setArmorType(string $armorType): self
    {
        $this->armorType = $armorType;

        return $this;
    }

    public function getArmorClass(): ?string
    {
        return $this->armorClass;
    }

    public function setArmorClass(?string $armorClass): self
    {
        $this->armorClass = $armorClass;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDiscretion(): ?string
    {
        return $this->discretion;
    }

    public function setDiscretion(?string $discretion): self
    {
        $this->discretion = $discretion;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return Collection<int, PlayableClass>
     */
    public function getPlayableClasses(): Collection
    {
        return $this->playableClasses;
    }

    public function addPlayableClass(PlayableClass $playableClass): self
    {
        if (!$this->playableClasses->contains($playableClass)) {
            $this->playableClasses[] = $playableClass;
            $playableClass->addArmor($this);
        }

        return $this;
    }

    public function removePlayableClass(PlayableClass $playableClass): self
    {
        if ($this->playableClasses->removeElement($playableClass)) {
            $playableClass->removeArmor($this);
        }

        return $this;
    }
}
