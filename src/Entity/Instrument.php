<?php

namespace App\Entity;

use App\Repository\InstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: InstrumentRepository::class)]
#[UniqueEntity('fct_id')]
#[UniqueEntity('name')]
class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $name;

    #[ORM\Column(type: 'string', length: 10, unique: true)]
    private string $fct_id;

    #[ORM\ManyToMany(targetEntity: Musician::class, mappedBy: 'instruments')]
    private Collection $musicians;

    public function __construct()
    {
        $this->musician = new ArrayCollection();
        $this->instruments = new ArrayCollection();
        $this->musicians = new ArrayCollection();
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

    public function getFctId(): ?string
    {
        return $this->fct_id;
    }

    public function setFctId(string $fct_id): self
    {
        $this->fct_id = $fct_id;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMusician(): Collection
    {
        return $this->musician;
    }

    /**
     * @return Collection<int, self>
     */
    public function getInstruments(): Collection
    {
        return $this->instruments;
    }

    /**
     * @return Collection<int, Musician>
     */
    public function getMusicians(): Collection
    {
        return $this->musicians;
    }

    public function addMusician(Musician $musician): self
    {
        if (!$this->musicians->contains($musician)) {
            $this->musicians[] = $musician;
            $musician->addInstrument($this);
        }

        return $this;
    }

    public function removeMusician(Musician $musician): self
    {
        if ($this->musicians->removeElement($musician)) {
            $musician->removeInstrument($this);
        }

        return $this;
    }
}
