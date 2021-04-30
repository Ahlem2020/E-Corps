<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Seance
 *
 * @ORM\Table(name="seance")
 * @ORM\Entity
 */
class Seance
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSeance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idseance;

    /**
     * @var string
     *
     * @ORM\Column(name="titreSeance", type="string", length=45, nullable=false)
     * @Assert\NotBlank(message="Entrer une titre")
     * @Groups("seance:read")
     */
    private $titreseance;

    /**
     * @var string
     *
     * @ORM\Column(name="descSeance", type="string", length=225, nullable=false)
     * @Assert\NotBlank(message="Entrer une description")
     * @Groups("seance:read")
     */
    private $descseance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSeance", type="date", nullable=false)
     * @Assert\NotBlank(message="Entrer une date")
     * @Groups("seance:read")
     */
    private $dateseance;

    /**
     * @var string
     *
     * @ORM\Column(name="idcoach", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="un coach est nécessaire")
     * @Groups("seance:read")
     */
    private $idcoach;

    /**
     * @var int
     *
     * @ORM\Column(name="idroutine", type="integer", nullable=false)
     * @Assert\NotBlank(message="choisir un routine")
     * @Groups("seance:read")
     */
    private $idroutine;

    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="integer", nullable=false)
     * @Groups("seance:read")
     *
     */
    private $likes;
    /**
     * @var string
     *
     * @ORM\Column(name="groupe", type="string", nullable=false)
     * @Groups("seance:read")
     *
     */
    private $groupe;

    /**
     * @return string
     */
    public function getGroupe(): string
    {
        return $this->groupe;
    }

    /**
     * @param string $groupe
     */
    public function setGroupe(string $groupe): void
    {
        $this->groupe = $groupe;
    }

    public function getIdseance(): ?int
    {
        return $this->idseance;
    }

    public function getTitreseance(): ?string
    {
        return $this->titreseance;
    }

    public function setTitreseance(string $titreseance): self
    {
        $this->titreseance = $titreseance;

        return $this;
    }

    public function getDescseance(): ?string
    {
        return $this->descseance;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setDescseance(string $descseance): self
    {
        $this->descseance = $descseance;

        return $this;
    }

    public function getDateseance(): ?\DateTimeInterface
    {
        return $this->dateseance;
    }

    public function setDateseance(\DateTimeInterface $dateseance): self
    {
        $this->dateseance = $dateseance;

        return $this;
    }

    public function getIdcoach(): ?string
    {
        return $this->idcoach;
    }

    public function setIdcoach(string $idcoach): self
    {
        $this->idcoach = $idcoach;

        return $this;
    }

    public function getIdroutine(): ?int
    {
        return $this->idroutine;
    }

    public function setIdroutine(int $idroutine): self
    {
        $this->idroutine = $idroutine;

        return $this;
    }

    public function setLikes(int $likes): self
    {
        $this->$likes = $likes;

        return $this;
    }

    public function __toString(): string
    {
        return (string)$this->getIdseance();
    }

    public function incrementLikeCount(): self
    {
        $this->likes = $this->likes + 1;
        return $this;
    }
    public function setZeroLikes(): self
    {
        $this->likes = 0;
        return $this;
    }
}
