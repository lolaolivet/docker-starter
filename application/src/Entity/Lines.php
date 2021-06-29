<?php

namespace App\Entity;

use App\Repository\LinesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
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
     * @Groups({"list_lines", "show_line"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 255
     * )
     * @Groups({"list_lines", "show_line"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=DifficultyLevel::class)
     * @Groups({"show_line"})
     * @ORM\JoinTable(name="lines_difficulty_level")
     */
    private $difficulties;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Feedback", mappedBy="line", cascade={"remove"})
     * @Groups({"show_line"})
     * @ORM\JoinColumn(name="id", referencedColumnName="line_id")
     */
    private $feedbacks;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="lines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    public function __construct()
    {
        $this->difficulties = new ArrayCollection();
        $this->feedbacks = new ArrayCollection();
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
    public function getDifficulties(): Collection
    {
        return $this->difficulties;
    }

    public function addDifficulty(DifficultyLevel $difficulty): self
    {
        if (!$this->difficulties->contains($difficulty)) {
            $this->difficulties[] = $difficulty;
        }

        return $this;
    }

    public function removeDifficulty(DifficultyLevel $difficulty): self
    {
        $this->difficulties->removeElement($difficulty);

        return $this;
    }

    /**
    * @return Collection|Feedback[]
    */
    public function getFeedbacks(): Collection
    {
        return $this->feedbacks;
    }

    public function addFeedback(Feedback $feedback): self
    {
        if (!$this->feedbacks->contains($feedback)) {
            $this->feedbacks[] = $feedback;
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): self
    {
        $this->feedbacks->removeElement($feedback);

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
