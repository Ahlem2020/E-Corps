<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participante
 *
 * @ORM\Table(name="participante", indexes={@ORM\Index(name="ParticicpantE", columns={"ID_Event"})})
 * @ORM\Entity
 */
class Participante
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Participant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParticipant;

    /**
     * @var int
     *
     * @ORM\Column(name="compteLogin", type="integer", nullable=false)
     */
    private $comptelogin;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Event", referencedColumnName="ID_Event")
     * })
     */
    private $idEvent;

    public function getIdParticipant(): ?int
    {
        return $this->idParticipant;
    }

    public function getComptelogin(): ?int
    {
        return $this->comptelogin;
    }

    public function setComptelogin(int $comptelogin): self
    {
        $this->comptelogin = $comptelogin;

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


}
