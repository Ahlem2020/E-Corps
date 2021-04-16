<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="idCatEvent_idx", columns={"categorieE"})})
 * @ORM\Entity
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string
     * @Assert\NotBlank, (message=" Cette valeur ne doit pas être vide!!")

     * @ORM\Column(name="Nom_Event", type="string", length=100, nullable=false)
     */
    private $nomEvent;

    /**
     * @var string
     * @Assert\NotBlank, (message=" Cette valeur ne doit pas être vide!!")

     * @ORM\Column(name="Description_Event", type="string", length=250, nullable=false)
     */
    private $descriptionEvent;

    /**
     * @var string
     * @Assert\NotBlank, (message=" Cette valeur ne doit pas être vide!!")

     * @ORM\Column(name="IsActive", type="string", length=20, nullable=false)
     */
    private $isactive;

    /**
     * @var \DateTime
     * @Assert\NotBlank, (message=" Cette valeur ne doit pas être vide!!")

     * @ORM\Column(name="Date_deb_Event", type="date", nullable=false)
     */
    private $dateDebEvent;

    /**
     * @var \DateTime
     * @Assert\NotBlank, (message=" Cette valeur ne doit pas être vide!!")

     * @ORM\Column(name="Date_fin_Event", type="date", nullable=false)
     */
    private $dateFinEvent;

    /**
     * @var int|null
     * @Assert\NotBlank, (message=" Cette valeur ne doit pas être vide!!")

     * @ORM\Column(name="categorieE", type="integer", nullable=true)
     */
    private $categoriee;

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function getNomEvent(): ?string
    {
        return $this->nomEvent;
    }

    public function setNomEvent(string $nomEvent): self
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    public function getDescriptionEvent(): ?string
    {
        return $this->descriptionEvent;
    }

    public function setDescriptionEvent(string $descriptionEvent): self
    {
        $this->descriptionEvent = $descriptionEvent;

        return $this;
    }

    public function getIsactive(): ?string
    {
        return $this->isactive;
    }

    public function setIsactive(string $isactive): self
    {
        $this->isactive = $isactive;

        return $this;
    }

    public function getDateDebEvent(): ?\DateTimeInterface
    {
        return $this->dateDebEvent;
    }

    public function setDateDebEvent(\DateTimeInterface $dateDebEvent): self
    {
        $this->dateDebEvent = $dateDebEvent;

        return $this;
    }

    public function getDateFinEvent(): ?\DateTimeInterface
    {
        return $this->dateFinEvent;
    }

    public function setDateFinEvent(\DateTimeInterface $dateFinEvent): self
    {
        $this->dateFinEvent = $dateFinEvent;

        return $this;
    }

    public function getCategoriee(): ?int
    {
        return $this->categoriee;
    }

    public function setCategoriee(?int $categoriee): self
    {
        $this->categoriee = $categoriee;

        return $this;
    }


}
