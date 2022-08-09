<?php

namespace App\Entity;

use App\Repository\MusicalWorkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicalWorkRepository::class)]
class MusicalWork
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'string', length: 255)]
    private string $status;

    #[ORM\ManyToOne(targetEntity: Compositor::class, inversedBy: 'musicalWorks')]
    private $compositor;


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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCompositor(): ?Compositor
    {
        return $this->compositor;
    }

    public function setCompositor(?Compositor $compositor): self
    {
        $this->compositor = $compositor;

        return $this;
    }

}
