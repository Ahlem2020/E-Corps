<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Categorieevent
 *
 * @ORM\Table(name="categorieevent")
 * @ORM\Entity
 *
 */
class Categorieevent
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_CategorieE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *

     */
    private $idCategorieE;

    /**
     * @var string
     *
     * @ORM\Column(name="NameCat", type="string", length=20, nullable=false)
     * @Assert\NotBlank, (message=" Cette valeur ne doit pas être vide!!")
     */
    private $namecat;

    /**
     * @var string
     *@Assert\NotBlank, (msg="Champ Obligatoire ")
     * @ORM\Column(name="DesCatEvent", type="string", length=250, nullable=false)
     */
    private $descatevent;

    public function getIdCategorieE(): ?int
    {
        return $this->idCategorieE;
    }

    public function getNamecat(): ?string
    {
        return $this->namecat;
    }

    public function setNamecat(string $namecat): self
    {
        $this->namecat = $namecat;

        return $this;
    }

    public function getDescatevent(): ?string
    {
        return $this->descatevent;
    }

    public function setDescatevent(string $descatevent): self
    {
        $this->descatevent = $descatevent;

        return $this;
    }

}
