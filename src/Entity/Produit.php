<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @UniqueEntity(
 *     fields={"NomProduit", "Description", "Prix", "Quantite", "Categories"},
 *     message="Produit existant"
 * )
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir le nom de produit")
     * @Assert\Regex(
     *     pattern = "/^[a-zA-Z]+([a-zA-Z0-9_ .,()%]*)$/i",
     *     htmlPattern = "[a-zA-Z]+([a-zA-Z0-9_ .,()%]*)", message="Le nom de produit {{ value }} ne peut pas être de cette façon"
     * )
     * @Groups("post:read")
     */
    private $NomProduit;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir la description")
     *
     * @Groups("post:read")
     */
    private $Description;

    /**
     * @ORM\Column(type="float")
     * @Assert\Positive(message="Le Prix {{ value }} ne peut pas être négatif")
     * @Assert\NotBlank(message="Veuillez saisir le prix")
     *
     * @Groups("post:read")
     */
    private $Prix;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive(message="La quantité {{ value }} ne peut pas être négative")
     * @Assert\NotBlank(message="veuillez saisir la quantite")
     * @Groups("post:read")
     *
     */
    private $Quantite;

    /**
     * @ORM\Column(type="string", length=255)
     *
     *@Groups("post:read")
     */
    private $Image;

    /**
     * @ORM\ManyToOne(targetEntity=CategoriePr::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="veuillez saisir une categorie")
     * @Groups("post:read")
     */
    private $Categories;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Reports;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->NomProduit;
    }

    public function setNomProduit(string $NomProduit): self
    {
        $this->NomProduit = $NomProduit;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getCategories(): ?CategoriePr
    {
        return $this->Categories;
    }

    public function setCategories(?CategoriePr $Categories): self
    {
        $this->Categories = $Categories;

        return $this;
    }

    public function getReports(): ?int
    {
        return $this->Reports;
    }

    public function setReports(?int $Reports): self
    {
        $this->Reports = $Reports;

        return $this;
    }
}
