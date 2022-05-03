<?php

namespace App\Entity;

use App\Repository\SubclassRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubclassRepository::class)
 */
class Subclass
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
     * @ORM\ManyToOne(targetEntity=PlayableClass::class, inversedBy="subclasses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playableClass;

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

    public function getPlayableClass(): ?PlayableClass
    {
        return $this->playableClass;
    }

    public function setPlayableClass(?PlayableClass $playableClass): self
    {
        $this->playableClass = $playableClass;

        return $this;
    }
}
