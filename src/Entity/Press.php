<?php

namespace App\Entity;

use App\Repository\PressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PressRepository::class)]
class Press
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $newspaper;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'date')]
    private $article_date;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Url(
        protocols: ['https']
    )]
    private $article_link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewspaper(): ?string
    {
        return $this->newspaper;
    }

    public function setNewspaper(string $newspaper): self
    {
        $this->newspaper = $newspaper;

        return $this;
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

    public function getArticleDate(): ?\DateTimeInterface
    {
        return $this->article_date;
    }

    public function setArticleDate(\DateTimeInterface $article_date): self
    {
        $this->article_date = $article_date;

        return $this;
    }

    public function getArticleLink(): ?string
    {
        return $this->article_link;
    }

    public function setArticleLink(string $article_link): self
    {
        $this->article_link = $article_link;

        return $this;
    }
}
