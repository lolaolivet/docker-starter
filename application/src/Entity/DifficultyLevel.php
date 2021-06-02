<?php

namespace App\Entity;

use App\Repository\DifficultyLevelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DifficultyLevelRepository::class)
 */
class DifficultyLevel
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
    private $difficulty;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $notation_fr;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $notation_de;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $colour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getNotationFr(): ?string
    {
        return $this->notation_fr;
    }

    public function setNotationFr(string $notation_fr): self
    {
        $this->notation_fr = $notation_fr;

        return $this;
    }

    public function getNotationDe(): ?string
    {
        return $this->notation_de;
    }

    public function setNotationDe(string $notation_de): self
    {
        $this->notation_de = $notation_de;

        return $this;
    }

    public function getColour(): ?string
    {
        return $this->colour;
    }

    public function setColour(string $colour): self
    {
        $this->colour = $colour;

        return $this;
    }
}
