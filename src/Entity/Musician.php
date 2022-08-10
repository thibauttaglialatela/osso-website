<?php

namespace App\Entity;

use App\Repository\MusicianRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MusicianRepository::class)]
#[ORM\Table(name: 'musician')]
class Musician
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 255,
        normalizer: 'trim',
        minMessage: 'Le nom de famille doit avoir au moins {{ limit }} caractéres de long',
        maxMessage: 'Le nom de famille ne peut pas dépasser {{ limit }} caractéres'
    )]
    private string $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Le prénom doit avoir au moins {{ limit }} caractéres de long',
        maxMessage: 'Le prénom ne peut pas dépasser {{ limit }} caractéres',
        normalizer: 'trim'
    )]
    private string $firstname;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private ?string $status;

    #[ORM\ManyToMany(targetEntity: Instrument::class, inversedBy: 'musicians')]
    private Collection $instruments;

    public function __toString(): string
    {
        return $this->getFirstname().' '.$this->getLastname();
    }

    public function __construct()
    {
        $this->instruments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Instrument>
     */
    public function getInstruments(): Collection
    {
        return $this->instruments;
    }

    public function addInstrument(Instrument $instrument): self
    {
        if (!$this->instruments->contains($instrument)) {
            $this->instruments[] = $instrument;
        }

        return $this;
    }

    public function removeInstrument(Instrument $instrument): self
    {
        $this->instruments->removeElement($instrument);

        return $this;
    }
}
