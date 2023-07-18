<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[Groups(['brand_list', 'list', 'detail'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['brand_list', 'list', 'detail'])]
    #[ORM\Column(length: 25)]
    private ?string $name = null;

    #[Groups(['list'])]
    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Guitar::class)]
    private Collection $guitars;

    public function __construct()
    {
        $this->guitars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Guitar>
     */
    public function getGuitars(): Collection
    {
        return $this->guitars;
    }

    public function addGuitar(Guitar $guitar): static
    {
        if (!$this->guitars->contains($guitar)) {
            $this->guitars->add($guitar);
            $guitar->setBrand($this);
        }

        return $this;
    }

    public function removeGuitar(Guitar $guitar): static
    {
        if ($this->guitars->removeElement($guitar)) {
            // set the owning side to null (unless already changed)
            if ($guitar->getBrand() === $this) {
                $guitar->setBrand(null);
            }
        }

        return $this;
    }
}
