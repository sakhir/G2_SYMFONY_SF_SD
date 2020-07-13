<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Batiment::class, inversedBy="chambres")
     */
    private $numeroBatiment;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="chambre")
     */
    private $etudiants;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="chambre")
     */
    private $etudiant;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="chambre")
     */
    private $chambre;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
        $this->chambre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?String
    {
        return $this->numero;
    }

    public function setNumero(String $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNumeroBatiment(): ?Batiment
    {
        return $this->numeroBatiment;
    }

    public function setNumeroBatiment(?Batiment $numeroBatiment): self
    {
        $this->numeroBatiment = $numeroBatiment;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setChambre($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->contains($etudiant)) {
            $this->etudiants->removeElement($etudiant);
            // set the owning side to null (unless already changed)
            if ($etudiant->getChambre() === $this) {
                $etudiant->setChambre(null);
            }
        }

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getChambre(): Collection
    {
        return $this->chambre;
    }

    public function addChambre(Etudiant $chambre): self
    {
        if (!$this->chambre->contains($chambre)) {
            $this->chambre[] = $chambre;
            $chambre->setChambre($this);
        }

        return $this;
    }

    public function removeChambre(Etudiant $chambre): self
    {
        if ($this->chambre->contains($chambre)) {
            $this->chambre->removeElement($chambre);
            // set the owning side to null (unless already changed)
            if ($chambre->getChambre() === $this) {
                $chambre->setChambre(null);
            }
        }

        return $this;
    }
}