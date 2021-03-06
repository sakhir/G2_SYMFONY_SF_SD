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

    /**
     * @ORM\Column(type="integer")
     */
    private $tel;

    /**
     * @ORM\Column(type="date")
     */
    private $DateDeNaissance;

    /**
     * @ORM\Column(type="date")
     */
    private $Dateinscription;

    /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
     private $addresse;

    /**
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $loge;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $bourse;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="chambre")
     */
    private $chambre;

    /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    private $nomchambre;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function getLoge(): ?string
    {
        return $this->loge;
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

    public function setAddresse(string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }
    public function setLoge(string $loge): self
    {
        $this->loge = $loge;

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

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

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

    public function getDateinscription(): ?\DateTimeInterface
    {
        return $this->Dateinscription;
    }

    public function setDateinscription(\DateTimeInterface $Dateinscription): self
    {
        $this->Dateinscription = $Dateinscription;

        return $this;
    }


    public function getBourse(): ?String
    {
        return $this->bourse;
    }
    public function getNomchambre(): ?String
    {
        return $this->nomchambre;
    }


    public function setBourse(String $bourse): self
    {
        $this->bourse = $bourse;

        return $this;
    }
    public function setNomchambre(String $nc): self
    {
        $this->nomchambre= $nc;

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

   public function __toString()
   {
       // TODO: Implement __toString() method.
       return $this->chambre;

   }

}
