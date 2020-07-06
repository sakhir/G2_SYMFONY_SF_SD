<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Regex(pattern= "/^[a-z]+$/i",message="nom invalide")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Regex(pattern= "/^[a-z]+$/i",message="prenom invalide")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Regex(pattern="/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/", message="Email invalide") 
     */
    private $email;

    /**g
     * @ORM\Column(type="integer")
     * @Assert\Regex(pattern="/(7|8|9)\d{9}/", message="numero incorrect") 
     */
    private $telephone;

    /**
     * @ORM\Column(type="date")
     */
    private $DateDeNaissance;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="etudiants")
     */
    private $chambre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bourse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->DateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $DateDeNaissance): self
    {
        $this->DateDeNaissance = $DateDeNaissance;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getBourse(): ?bool
    {
        return $this->bourse;
    }

    public function setBourse(bool $bourse): self
    {
        $this->bourse = $bourse;

        return $this;
    }
}
