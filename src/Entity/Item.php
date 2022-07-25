<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank
     * @Assert\Length(min=1,max=255, minMessage="minErrorMessage",maxMessage="MaxErrorMessage")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Groups("read_class")
     * @Groups("read_backgrounds")
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $weight;

    /**
     * @ORM\ManyToMany(targetEntity=Background::class, mappedBy="items")
     */
    private $backgrounds;

    /**
     * @ORM\OneToMany(targetEntity=PlayableClassItem::class, mappedBy="item", orphanRemoval=true)
     */
    private $playableClassItems;

    public function __construct()
    {
        $this->backgrounds = new ArrayCollection();
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
            $playableClassItem->setItem($this);
        }

        return $this;
    }

    public function removePlayableClassItem(PlayableClassItem $playableClassItem): self
    {
        if ($this->playableClassItems->removeElement($playableClassItem)) {
            // set the owning side to null (unless already changed)
            if ($playableClassItem->getItem() === $this) {
                $playableClassItem->setItem(null);
            }
        }

        return $this;
    }
}
