<?php

namespace App\Entity;

use App\Repository\InstrumentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InstrumentRepository::class)]
class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 10)]
    #[Assert\Unique]
    private $fct_id;

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
}
