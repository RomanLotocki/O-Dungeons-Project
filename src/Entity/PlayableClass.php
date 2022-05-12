<?php

namespace App\Entity;

use App\Repository\PlayableClassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PlayableClassRepository::class)
 */
class PlayableClass
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("browse_class")
     * @Groups("read_class")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("browse_class")
     * @Groups("read_class")
     * @Assert\NotBlank
     * @Assert\Length(min=1)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups("read_class")
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("read_class")
     * @Assert\NotBlank
     * @Assert\Length(min=3,minMessage="Il faut au minimum trois caractères")
     */
    private $lifeDice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("browse_class")
     * @Groups("read_class")
     * @Assert\NotBlank
     * @Assert\Url
     */
    private $imageUrl;

    /**
     * @ORM\OneToMany(targetEntity=Subclass::class, mappedBy="playableClass", orphanRemoval=true)
     * @Groups("read_class")
     */
    private $subclasses;

    /**
     * @ORM\ManyToMany(targetEntity=Ability::class, inversedBy="playableClasses")
     */
    private $abilities;

    /**
     * @ORM\ManyToMany(targetEntity=Armor::class, inversedBy="playableClasses")
     * @Groups("read_class")
     */
    private $armors;

    /**
     * @ORM\ManyToMany(targetEntity=Weapon::class, inversedBy="playableClasses")
     * @Groups("read_class")
     */
    private $weapons;

    /**
     * @ORM\OneToMany(targetEntity=PlayableClassItem::class, mappedBy="playableClass", orphanRemoval=true, cascade={"persist"})
     * @Groups("read_class")
     */
    private $playableClassItems;

    /**
     * @ORM\Column(type="text")
     * @Groups("browse_class")
     */
    private $quickDescription;

    public function __construct()
    {
        $this->subclasses = new ArrayCollection();
        $this->abilities = new ArrayCollection();
        $this->armors = new ArrayCollection();
        $this->weapons = new ArrayCollection();
        $this->playableClassItems = new ArrayCollection();
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

    /**
     * @return Collection<int, PlayableClassItem>
     */
    public function getPlayableClassItems(): Collection
    {
        return $this->playableClassItems;
    }

    public function addPlayableClassItem(PlayableClassItem $playableClassItem): self
    {
        if (!$this->playableClassItems->contains($playableClassItem)) {
            $this->playableClassItems[] = $playableClassItem;
            $playableClassItem->setPlayableClass($this);
        }

        return $this;
    }

    public function removePlayableClassItem(PlayableClassItem $playableClassItem): self
    {
        if ($this->playableClassItems->removeElement($playableClassItem)) {
            // set the owning side to null (unless already changed)
            if ($playableClassItem->getPlayableClass() === $this) {
                $playableClassItem->setPlayableClass(null);
            }
        }

        return $this;
    }

    public function getQuickDescription(): ?string
    {
        return $this->quickDescription;
    }

    public function setQuickDescription(string $quickDescription): self
    {
        $this->quickDescription = $quickDescription;

        return $this;
    }
}
