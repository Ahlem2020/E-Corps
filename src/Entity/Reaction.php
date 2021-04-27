<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reaction
 *
 * @ORM\Table(name="reaction", indexes={@ORM\Index(name="ReactEvent", columns={"ID_Event"}), @ORM\Index(name="ReactUser", columns={"compteLogin"})})
 * @ORM\Entity
 */
class Reaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReaction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreaction;

    /**
     * @var string
     *
     * @ORM\Column(name="typeReaction", type="string", length=200, nullable=false)
     */
    private $typereaction;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Event", referencedColumnName="ID_Event")
     * })
     */
    private $idEvent;

    /**
     * @var \Compte
     *
     * @ORM\ManyToOne(targetEntity="Compte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="compteLogin", referencedColumnName="compteLogin")
     * })
     */
    private $comptelogin;

    public function getIdreaction(): ?int
    {
        return $this->idreaction;
    }

    public function getTypereaction(): ?string
    {
        return $this->typereaction;
    }

    public function setTypereaction(string $typereaction): self
    {
        $this->typereaction = $typereaction;

        return $this;
    }

    public function getIdEvent(): ?Event
    {
        return $this->idEvent;
    }

    public function setIdEvent(?Event $idEvent): self
    {
        $this->idEvent = $idEvent;

        return $this;
    }

    public function getComptelogin(): ?Compte
    {
        return $this->comptelogin;
    }

    public function setComptelogin(?Compte $comptelogin): self
    {
        $this->comptelogin = $comptelogin;

        return $this;
    }


}
