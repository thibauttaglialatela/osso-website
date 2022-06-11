<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 400)]
    private $summary;

    #[ORM\Column(type: 'text')]
    private $body;

    #[ORM\Column(type: 'date')]
    private $date;


    #[ORM\OneToMany(mappedBy: 'event', targetEntity: MusicalWork::class)]
    private $musical_work;

    #[ORM\Column(type: 'string', length: 50)]
    private $category;

    public function __construct()
    {
        $this->musical_work = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }


    /**
     * @return Collection<int, MusicalWork>
     */
    public function getMusicalWork(): Collection
    {
        return $this->musical_work;
    }

    public function addMusicalWork(MusicalWork $musicalWork): self
    {
        if (!$this->musical_work->contains($musicalWork)) {
            $this->musical_work[] = $musicalWork;
            $musicalWork->setEvent($this);
        }

        return $this;
    }

    public function removeMusicalWork(MusicalWork $musicalWork): self
    {
        if ($this->musical_work->removeElement($musicalWork)) {
            // set the owning side to null (unless already changed)
            if ($musicalWork->getEvent() === $this) {
                $musicalWork->setEvent(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }
}
