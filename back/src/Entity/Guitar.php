<?php

namespace App\Entity;

use App\Repository\GuitarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GuitarRepository::class)]
class Guitar
{
    #[Groups('list')]
    #[Groups('detail')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('list')]
    #[Groups('detail')]
    #[ORM\Column(length: 100)]
    private ?string $reference = null;

    #[Groups('list')]
    #[Groups('detail')]
    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'guitars')]
    #[ORM\JoinColumn(nullable: false, name:'brand_id')]
    private ?Brand $brand = null;

    #[Groups('list')]
    #[Groups('detail')]
    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
