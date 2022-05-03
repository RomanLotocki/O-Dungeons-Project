<?php

namespace App\Entity;

use App\Repository\PlayableClassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayableClassRepository::class)
 */
class PlayableClass
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lifeDice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\OneToMany(targetEntity=Subclass::class, mappedBy="playableClass", orphanRemoval=true)
     */
    private $subclasses;

    /**
     * @ORM\ManyToMany(targetEntity=Item::class, inversedBy="playableClasses")
     */
    private $items;

    /**
     * @ORM\ManyToMany(targetEntity=Ability::class, inversedBy="playableClasses")
     */
    private $abilities;

    /**
     * @ORM\ManyToMany(targetEntity=Armor::class, inversedBy="playableClasses")
     */
    private $armors;

    /**
     * @ORM\ManyToMany(targetEntity=Weapon::class, inversedBy="playableClasses")
     */
    private $weapons;

    public function __construct()
    {
        $this->subclasses = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->abilities = new ArrayCollection();
        $this->armors = new ArrayCollection();
        $this->weapons = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLifeDice(): ?string
    {
        return $this->lifeDice;
    }

    public function setLifeDice(string $lifeDice): self
    {
        $this->lifeDice = $lifeDice;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return Collection<int, Subclass>
     */
    public function getSubclasses(): Collection
    {
        return $this->subclasses;
    }

    public function addSubclass(Subclass $subclass): self
    {
        if (!$this->subclasses->contains($subclass)) {
            $this->subclasses[] = $subclass;
            $subclass->setPlayableClass($this);
        }

        return $this;
    }

    public function removeSubclass(Subclass $subclass): self
    {
        if ($this->subclasses->removeElement($subclass)) {
            // set the owning side to null (unless already changed)
            if ($subclass->getPlayableClass() === $this) {
                $subclass->setPlayableClass(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        $this->items->removeElement($item);

        return $this;
    }

    /**
     * @return Collection<int, Ability>
     */
    public function getAbilities(): Collection
    {
        return $this->abilities;
    }

    public function addAbility(Ability $ability): self
    {
        if (!$this->abilities->contains($ability)) {
            $this->abilities[] = $ability;
        }

        return $this;
    }

    public function removeAbility(Ability $ability): self
    {
        $this->abilities->removeElement($ability);

        return $this;
    }

    /**
     * @return Collection<int, Armor>
     */
    public function getArmors(): Collection
    {
        return $this->armors;
    }

    public function addArmor(Armor $armor): self
    {
        if (!$this->armors->contains($armor)) {
            $this->armors[] = $armor;
        }

        return $this;
    }

    public function removeArmor(Armor $armor): self
    {
        $this->armors->removeElement($armor);

        return $this;
    }

    /**
     * @return Collection<int, Weapon>
     */
    public function getWeapons(): Collection
    {
        return $this->weapons;
    }

    public function addWeapon(Weapon $weapon): self
    {
        if (!$this->weapons->contains($weapon)) {
            $this->weapons[] = $weapon;
        }

        return $this;
    }

    public function removeWeapon(Weapon $weapon): self
    {
        $this->weapons->removeElement($weapon);

        return $this;
    }
}
