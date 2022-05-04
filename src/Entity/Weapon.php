<?php

namespace App\Entity;

use App\Repository\WeaponRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=WeaponRepository::class)
 */
class Weapon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read_class")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read_class")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read_class")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("read_class")
     */
    private $damageDice;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("read_class")
     */
    private $damageType;

    /**
     * @ORM\Column(type="float", options={"default": 0})
     * @Groups("read_class")
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("read_class")
     */
    private $property;

    /**
     * @ORM\ManyToMany(targetEntity=PlayableClass::class, mappedBy="weapons")
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDamageDice(): ?string
    {
        return $this->damageDice;
    }

    public function setDamageDice(string $damageDice): self
    {
        $this->damageDice = $damageDice;

        return $this;
    }

    public function getDamageType(): ?string
    {
        return $this->damageType;
    }

    public function setDamageType(string $damageType): self
    {
        $this->damageType = $damageType;

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

    public function getProperty(): ?string
    {
        return $this->property;
    }

    public function setProperty(?string $property): self
    {
        $this->property = $property;

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
            $playableClass->addWeapon($this);
        }

        return $this;
    }

    public function removePlayableClass(PlayableClass $playableClass): self
    {
        if ($this->playableClasses->removeElement($playableClass)) {
            $playableClass->removeWeapon($this);
        }

        return $this;
    }
}
