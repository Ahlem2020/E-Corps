<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participante
 *
 * @ORM\Table(name="participante")
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
     * @var int
     *
     * @ORM\Column(name="ID_Event", type="integer", nullable=false)
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

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function setIdEvent(int $idEvent): self
    {
        $this->idEvent = $idEvent;

        return $this;
    }


}
