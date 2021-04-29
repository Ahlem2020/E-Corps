<?php

namespace App\Entity;

use App\Repository\CategoriePrRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategoriePrRepository::class)
 * @UniqueEntity(
 *     fields={"Description"},
 *     message="Categorie existante"
 * )
 */
class CategoriePr
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *    pattern = "/^[a-zA-Z]+([a-zA-Z0-9_ .,()%<>]*)$/i",
     *     htmlPattern = "[a-zA-Z]+([a-zA-Z0-9_ .,()%]<>*)", message="La catégorie {{ value }} ne peut pas être de cette façon"
     * )
     * @Assert\NotBlank(message="Veuillez saisir une description")
     */
    private $Description;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="Categories", orphanRemoval=true)
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setCategories($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCategories() === $this) {
                $produit->setCategories(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Description;
    }
}
