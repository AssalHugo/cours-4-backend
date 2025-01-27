<?php

namespace App\Entity;

use App\Repository\BatimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BatimentRepository::class)]
class Batiment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numero = null;

    /**
     * @var Collection<int, Personne>
     */
    #[ORM\ManyToMany(targetEntity: Personne::class, inversedBy: 'batiments')]
    private Collection $personne;

    public function __construct()
    {
        $this->personne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getPersonne(): Collection
    {
        return $this->personne;
    }

    public function addPersonne(Personne $personne): static
    {
        if (!$this->personne->contains($personne)) {
            $this->personne->add($personne);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): static
    {
        $this->personne->removeElement($personne);

        return $this;
    }
}
