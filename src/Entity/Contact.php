<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\Length(min: 2, max: 100)]
    private ?string $fullName = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 100)]
    #[Assert\Email(
        message: "L'email {{ value }} n'est pas valide"
    )]
    private string $email;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\Length(min: 2, max: 100)]
    #[Assert\NotBlank]
    private ?string $subject = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    private string $message;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotBlank]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $hasAcceptedPrivacy;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isHasAcceptedPrivacy(): ?bool
    {
        return $this->hasAcceptedPrivacy;
    }

    public function setHasAcceptedPrivacy(bool $hasAcceptedPrivacy): self
    {
        $this->hasAcceptedPrivacy = $hasAcceptedPrivacy;

        return $this;
    }
}
