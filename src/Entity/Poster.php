<?php

namespace App\Entity;

use App\Repository\PosterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PosterRepository::class)]
#[Vich\Uploadable]
class Poster
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Vich\UploadableField(mapping: 'poster_file', fileNameProperty: 'imageFilename')]
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
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true, length: 255)]
    private ?string $imageFilename = null;

    #[ORM\Column(type: 'date')]
    private $updated_at;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $author;

    #[ORM\Column(type: 'string', length: 255)]
    private $alt;

    #[ORM\ManyToOne(targetEntity: Gallery::class, inversedBy: 'posters', cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    private $gallery;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            $this->updated_at = new \DateTimeImmutable();
        }
    }

    /**
     * @return string|null
     */
    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    /**
     * @param string|null $imageFilename
     */
    public function setImageFilename(?string $imageFilename): void
    {
        $this->imageFilename = $imageFilename;
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
}
