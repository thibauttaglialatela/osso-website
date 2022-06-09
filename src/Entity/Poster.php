<?php

namespace App\Entity;

use App\Repository\PosterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PosterRepository::class)]
class Poster
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $image_file;

    #[ORM\Column(type: 'string', length: 255)]
    private $image_name;

    #[ORM\Column(type: 'date')]
    private $updated_at;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $author;

    #[ORM\Column(type: 'string', length: 255)]
    private $alt;

    #[ORM\ManyToOne(targetEntity: Gallery::class, inversedBy: 'posters')]
    #[ORM\JoinColumn(nullable: false)]
    private $gallery;

    #[ORM\OneToMany(mappedBy: 'poster', targetEntity: Event::class)]
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageFile(): ?string
    {
        return $this->image_file;
    }

    public function setImageFile(string $image_file): self
    {
        $this->image_file = $image_file;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->image_name;
    }

    public function setImageName(string $image_name): self
    {
        $this->image_name = $image_name;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    public function setGallery(?Gallery $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setPoster($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getPoster() === $this) {
                $event->setPoster(null);
            }
        }

        return $this;
    }

}
