<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[Vich\Uploadable]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 400)]
    #[Assert\Length(
        max:400,
        maxMessage: 'Le résume ne peut pas faire plus de {{ limit }} de caractéres de long'
    )]
    private $summary;

    #[ORM\Column(type: 'text')]
    private $body;

    #[ORM\Column(type: 'string', length: 50)]
    private $category;

    #[Vich\UploadableField(mapping: 'poster_file', fileNameProperty: 'posterFilename')]
    #[Assert\File(
        maxSize: '2M',
        maxSizeMessage: 'Le fichier est trop grand ({{ size }} {{ suffix }}. La taille maximale autorisée est {{ limit }} {{ suffix }}',
        mimeTypes: [
            'image/jpeg',
            'image/png',
            'image/webp'
        ],
        mimeTypesMessage: 'Veuillez télécharger un fichier de type {{ types }}'
    )]
    private ?File $poster = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $posterFilename = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetime')]
    private $start_at;

    #[ORM\Column(type: 'datetime')]
    private $end_at;

    #[ORM\Column(type: 'string', length: 100)]
    private $localisation;


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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPoster(): ?File
    {
        return $this->poster;
    }

    public function setPoster(?File $poster = null): void
    {
        $this->poster = $poster;
        if (null !== $poster) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function setPosterFilename(?string $posterFilename): void
    {
        $this->posterFilename = $posterFilename;
    }

    public function getPosterFilename(): ?string
    {
        return $this->posterFilename;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->start_at;
    }

    public function setStartAt(\DateTimeInterface $start_at): self
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->end_at;
    }

    public function setEndAt(\DateTimeInterface $end_at): self
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

}
