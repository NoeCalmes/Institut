<?php

namespace App\Entity;

use App\Repository\StagiaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
    private ?\DateTimeInterface $datenaissance = null;

     #[ORM\ManyToMany(targetEntity: Stage::class, inversedBy: "stagiaires")]
     #[ORM\JoinTable(name: "stagiaire_stage")] // Table de jointure
     private Collection $stages;

     public function __construct()
     {
         $this->stages = new ArrayCollection();
     }

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

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;
        return $this;
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
