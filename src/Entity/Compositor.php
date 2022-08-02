<?php

namespace App\Entity;

use App\Repository\CompositorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CompositorRepository::class)]
#[UniqueEntity('name')]
class Compositor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'compositor', targetEntity: MusicalWork::class)]
    private Collection $musicalWorks;

    public function __construct()
    {
        $this->musicalWorks = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName();
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
     * @return Collection<int, MusicalWork>
     */
    public function getMusicalWorks(): Collection
    {
        return $this->musicalWorks;
    }

    public function addMusicalWork(MusicalWork $musicalWork): self
    {
        if (!$this->musicalWorks->contains($musicalWork)) {
            $this->musicalWorks[] = $musicalWork;
            $musicalWork->setCompositor($this);
        }

        return $this;
    }

    public function removeMusicalWork(MusicalWork $musicalWork): self
    {
        if ($this->musicalWorks->removeElement($musicalWork)) {
            // set the owning side to null (unless already changed)
            if ($musicalWork->getCompositor() === $this) {
                $musicalWork->setCompositor(null);
            }
        }

        return $this;
    }
}
