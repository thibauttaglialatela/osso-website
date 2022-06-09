<?php

namespace App\Entity;

use App\Repository\PosterRepository;
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
}
