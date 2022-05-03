<?php

namespace App\Entity;

use App\Repository\AbilityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbilityRepository::class)
 */
class Ability
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $quickDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $incantationTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $abilityRange;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $component;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    /**
     * @ORM\ManyToMany(targetEntity=PlayableClass::class, mappedBy="abilities")
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

    public function getQuickDescription(): ?string
    {
        return $this->quickDescription;
    }

    public function setQuickDescription(?string $quickDescription): self
    {
        $this->quickDescription = $quickDescription;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIncantationTime(): ?string
    {
        return $this->incantationTime;
    }

    public function setIncantationTime(string $incantationTime): self
    {
        $this->incantationTime = $incantationTime;

        return $this;
    }

    public function getAbilityRange(): ?string
    {
        return $this->abilityRange;
    }

    public function setAbilityRange(string $abilityRange): self
    {
        $this->abilityRange = $abilityRange;

        return $this;
    }

    public function getComponent(): ?string
    {
        return $this->component;
    }

    public function setComponent(string $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

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
            $playableClass->addAbility($this);
        }

        return $this;
    }

    public function removePlayableClass(PlayableClass $playableClass): self
    {
        if ($this->playableClasses->removeElement($playableClass)) {
            $playableClass->removeAbility($this);
        }

        return $this;
    }
}
