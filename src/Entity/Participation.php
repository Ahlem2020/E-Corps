<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="idSeance", columns={"idSeance"})})
 * @ORM\Entity
 * @UniqueEntity("idseance")
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idClient", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="Entrer une nom")
     */
    private $idclient;

    /**
     * @var string
     *
     * @ORM\Column(name="idcoach", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="Entrer un coach")
     */
    private $idcoach;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="Donner le status du séance")
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="idroutine", type="integer", nullable=false)
     * @Assert\NotBlank(message="Choisir un routine")
     */
    private $idroutine;

    /**
     * @var \Seance
     *
     * @ORM\ManyToOne(targetEntity="Seance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSeance", referencedColumnName="idSeance")
     * })
     * @Assert\NotBlank(message="Choisir une séance")
     *
     */
    private $idseance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdclient(): ?string
    {
        return $this->idclient;
    }

    public function setIdclient(string $idclient): self
    {
        $this->idclient = $idclient;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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

    public function getIdseance(): ?Seance
    {
        return $this->idseance;
    }

    public function setIdseance(?Seance $idseance): self
    {
        $this->idseance = $idseance;

        return $this;
    }


}
