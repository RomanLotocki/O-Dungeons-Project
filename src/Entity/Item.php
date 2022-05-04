<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read_class")
     * @Groups("read_backgrounds")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read_class")
     * @Groups("read_backgrounds")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Groups("read_class")
     * @Groups("read_backgrounds")
     */
    private $weight;

    /**
     * @ORM\ManyToMany(targetEntity=Background::class, mappedBy="items")
     */
    private $backgrounds;

    /**
     * @ORM\ManyToMany(targetEntity=PlayableClass::class, mappedBy="items")
     */
    private $playableClasses;

    public function __construct()
    {
        $this->backgrounds = new ArrayCollection();
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
     * @return Collection<int, Background>
     */
    public function getBackgrounds(): Collection
    {
        return $this->backgrounds;
    }

    public function addBackground(Background $background): self
    {
        if (!$this->backgrounds->contains($background)) {
            $this->backgrounds[] = $background;
            $background->addItem($this);
        }

        return $this;
    }

    public function removeBackground(Background $background): self
    {
        if ($this->backgrounds->removeElement($background)) {
            $background->removeItem($this);
        }

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
            $playableClass->addItem($this);
        }

        return $this;
    }

    public function removePlayableClass(PlayableClass $playableClass): self
    {
        if ($this->playableClasses->removeElement($playableClass)) {
            $playableClass->removeItem($this);
        }

        return $this;
    }
}
