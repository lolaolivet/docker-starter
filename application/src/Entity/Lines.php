<?php

namespace App\Entity;

use App\Repository\LinesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LinesRepository::class)
 * @ORM\Table(name="`lines`")
 */
class Lines
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
     * @Assert\Length(max=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=DifficultyLevel::class)
     */
    private $difficulty;

    public function __construct()
    {
        $this->difficulty = new ArrayCollection();
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

    /**
     * @return Collection|DifficultyLevel[]
     */
    public function getDifficulty(): Collection
    {
        return $this->difficulty;
    }

    public function addDifficulty(DifficultyLevel $difficulty): self
    {
        if (!$this->difficulty->contains($difficulty)) {
            $this->difficulty[] = $difficulty;
        }

        return $this;
    }

    public function removeDifficulty(DifficultyLevel $difficulty): self
    {
        $this->difficulty->removeElement($difficulty);

        return $this;
    }
}
