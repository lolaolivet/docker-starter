<?php

namespace App\Entity;

use App\Repository\DifficultyLevelRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank
     */
    private $difficulty;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 5,
     *      minMessage = "The french notation must at least have {{ limit }} charachters",
     *      maxMessage = "The french notation cannot have more than {{ limit }} charachters"
     * )
     */
    private $notation_fr;

    /**
     * @ORM\Column(type="string", length=2)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 2,
     *      minMessage = "The german notation must at least have {{ limit }} charachters",
     *      maxMessage = "The german notation cannot have more than {{ limit }} charachters"
     * )
     */
    private $notation_de;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Regex(
     *      pattern = "/^#(([0-9a-fA-F]{2}){3}|([0-9a-fA-F]){3})$/",
     *      match = true,
     *      message = "The color must be an hexadecimal"
     * )
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
