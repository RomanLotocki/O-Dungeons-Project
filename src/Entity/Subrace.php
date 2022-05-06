<?php

namespace App\Entity;

use App\Repository\SubraceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SubraceRepository::class)
 */
class Subrace
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read_race")
     * @Groups("browse_subraces")
     * @Groups("read_subraces")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read_race")
     * @Groups("browse_subraces")
     * @Groups("read_subraces")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups("read_race")
     * @Groups("read_subraces")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read_race")
     * @Groups("read_subraces")
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups("read_race")
     * @Groups("read_subraces")
     */
    private $strength;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups("read_race")
     * @Groups("read_subraces")
     */
    private $dexterity;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups("read_race")
     * @Groups("read_subraces")
     */
    private $constitution;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups("read_race")
     * @Groups("read_subraces")
     */
    private $wisdom;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups("read_race")
     * @Groups("read_subraces")
     */
    private $intelligence;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups("read_race")
     * @Groups("read_subraces")
     */
    private $charisma;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("read_race")
     * @Groups("read_subraces")
     */
    private $trait;

    /**
     * @ORM\ManyToOne(targetEntity=Race::class, inversedBy="subraces")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("read_subraces")
     */
    private $race;

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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

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

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(int $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getConstitution(): ?int
    {
        return $this->constitution;
    }

    public function setConstitution(int $constitution): self
    {
        $this->constitution = $constitution;

        return $this;
    }

    public function getWisdom(): ?int
    {
        return $this->wisdom;
    }

    public function setWisdom(int $wisdom): self
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): self
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getCharisma(): ?int
    {
        return $this->charisma;
    }

    public function setCharisma(int $charisma): self
    {
        $this->charisma = $charisma;

        return $this;
    }

    public function getTrait(): ?string
    {
        return $this->trait;
    }

    public function setTrait(?string $trait): self
    {
        $this->trait = $trait;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }
}
