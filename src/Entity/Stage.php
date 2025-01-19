<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: StageRepository::class)]
class Stage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Stagiaire::class, mappedBy: "stages")]
    private Collection $stagiaires;
    
    #[ORM\ManyToMany(targetEntity: Matiere::class, inversedBy: "stages")]
    #[ORM\JoinTable(name: "matiere_stage")]
    private Collection $matieres;
    public function __construct()
    {
        $this->stagiaires = new ArrayCollection();
        $this->matieres = new ArrayCollection();
    }


    public function getMatieres(): Collection
{
    return $this->matieres;
}

public function addMatiere(Matiere $matiere): self
{
    if (!$this->matieres->contains($matiere)) {
        $this->matieres[] = $matiere;
    }

    return $this;
}

public function removeMatiere(Matiere $matiere): self
{
    $this->matieres->removeElement($matiere);

    return $this;
}

public function getStagiaires(): Collection
{
    return $this->stagiaires;
}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;
    
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
