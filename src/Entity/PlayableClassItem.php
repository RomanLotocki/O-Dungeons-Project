<?php

namespace App\Entity;

use App\Repository\PlayableClassItemsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PlayableClassItemsRepository::class)
 */
class PlayableClassItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups("read_class")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=PlayableClass::class, inversedBy="playableClassItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playableClass;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="playableClassItems")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("read_class")
     */
    private $item;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPlayableClass(): ?PlayableClass
    {
        return $this->playableClass;
    }

    public function setPlayableClass(?PlayableClass $playableClass): self
    {
        $this->playableClass = $playableClass;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }
}
