<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity
 */
class Groupe
{
    /**
     * @var int
     *
     * @ORM\Column(name="idclass", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idclass;

    /**
     * @var string
     *
     * @ORM\Column(name="nomClass", type="string", length=25, nullable=false)
     * *@Assert\NotBlank(message="Entrer un nom valide " ,groups={"groupe"})
     */
    private $nomclass;

    /**
     * @var string
     *
     * @ORM\Column(name="typeClass", type="string", length=25, nullable=false)
     * *@Assert\NotBlank(message="Choisir un type du classe" ,groups={"groupe"})
     */
    private $typeclass;

    public function getIdclass(): ?int
    {
        return $this->idclass;
    }

    public function getNomclass(): ?string
    {
        return $this->nomclass;
    }

    public function setNomclass(?string $nomclass): self
    {
        $this->nomclass = $nomclass;

        return $this;
    }

    public function getTypeclass(): ?string
    {
        return $this->typeclass;
    }

    public function setTypeclass(?string $typeclass): self
    {
        $this->typeclass = $typeclass;

        return $this;
    }


}
