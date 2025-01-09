<?php

namespace App\Entity;

use App\Repository\StagiaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StagiaireRepository::class)]
class Stagiaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?float $Datenaissance = null;
    private Collection $stages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDatenaissance(): ?float
    {
        return $this->Datenaissance;
    }

    public function setDatenaissance(?float $Datenaissance): static
    {
        $this->Datenaissance = $Datenaissance;

        return $this;
    }
    
    public function __construct()
{
    $this->stages = new ArrayCollection();
}

public function getStages(): Collection
{
    return $this->stages;
}

public function addStage(Stage $stage): self
{
    if (!$this->stages->contains($stage)) {
        $this->stages[] = $stage;
    }

    return $this;
}

public function removeStage(Stage $stage): self
{
    $this->stages->removeElement($stage);

    return $this;
}
}
