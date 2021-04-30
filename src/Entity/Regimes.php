<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Regimes
 *
 *
 * @ORM\Table(name="regimes", indexes={@ORM\Index(columns={"Titre","Description","ImgUml"}, flags={"fulltext"})})
 * @UniqueEntity("titre")
 * @ORM\Entity(repositoryClass="App\Repository\MyClassRepository2")
 */
class Regimes
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *@Assert\NotBlank(message="Titre !")
     * @ORM\Column(name="Titre", type="string", length=15, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *@Assert\NotBlank(message="Desc !")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Description must be at least 3 characters long",
     *      maxMessage = "Description cannot be longer than 50 characters"
     * )
     * @Assert\NotEqualTo("mot1",
     *     message="Mot interdit détécté ({{ compared_value }})")
     * @Assert\NotEqualTo("mot2",
     *     message="Mot interdit détécté ({{ compared_value }})")
     * @Assert\NotEqualTo("mot3",
     *     message="Mot interdit détécté ({{ compared_value }})")
     * @ORM\Column(name="Description", type="string", length=60, nullable=false)
     */
    private $description;

    /**
     * @var string
     *@Assert\NotBlank(message="ImgUml !")
     *
     * @ORM\Column(name="ImgUml", type="string", length=30, nullable=false)
     */
    private $imguml;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getImguml(): ?string
    {
        return $this->imguml;
    }

    /**
     * @param string $imguml
     */
    public function setImguml(string $imguml): self
    {
        $this->imguml = $imguml;
        return $this;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return $this->getTitre();
        // to show the id of the Category in the select
        // return $this->id;
    }

}
