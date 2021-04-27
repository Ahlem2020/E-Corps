<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorieevent
 *
 * @ORM\Table(name="categorieevent")
 * @ORM\Entity
 */
class Categorieevent
{
    /**
     * @var int
     *
     * @ORM\Column(name="categorieE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoriee;

    /**
     * @var string
     *
     * @ORM\Column(name="NameCat", type="string", length=200, nullable=false)
     */
    private $namecat;

    /**
     * @var string
     *
     * @ORM\Column(name="DesCatEvent", type="string", length=250, nullable=false)
     */
    private $descatevent;

    public function getCategoriee(): ?int
    {
        return $this->categoriee;
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
    public function __toString()
    {
        return (string) $this->getCategoriee();
    }

}
