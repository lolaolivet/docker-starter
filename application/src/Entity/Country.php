<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $flag;

    /**
     * @ORM\OneToMany(targetEntity=Lines::class, mappedBy="country", orphanRemoval=true)
     */
    private $lines;

    public function __construct()
    {
        $this->line = new ArrayCollection();
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

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(?string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * @return Collection|Lines[]
     */
    public function getLines(): Collection
    {
        return $this->lines;
    }

    public function addLines(Lines $lines): self
    {
        if (!$this->lines->contains($lines)) {
            $this->lines[] = $lines;
            $lines->setCountry($this);
        }

        return $this;
    }

    public function removeLines(Lines $lines): self
    {
        if ($this->lines->removeElement($lines)) {
            // set the owning side to null (unless already changed)
            if ($lines->getCountry() === $this) {
                $lines->setCountry(null);
            }
        }

        return $this;
    }
}
