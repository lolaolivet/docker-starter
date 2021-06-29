<?php

namespace App\Entity;

use App\Repository\DifficultyLevelRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DifficultyLevelRepository::class)
 */
class DifficultyLevel
{
    public const  NOTATIONS_FR =  ['F' => 'F', 'PD' => 'PD', 'AD' => 'AD', 'D' => 'D',  'TD' => 'TD', 'ED' => 'ED'];

    public const NOTATIONS_DE = ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' => 'F'];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Groups({"show_line"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=5)
     *  @Groups({"show_line"})
     */
    private $notation_fr;

    /**
     * @ORM\Column(type="string", length=2)
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
    private $color;

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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
