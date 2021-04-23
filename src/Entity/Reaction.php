<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReactionRepository::class)
 */
class Reaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idReaction;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="reactions")
     */
    private $ID_Event;

    /**
     * @var integer
     *
     * @ORM\Column(name="typeReaction", type="integer", nullable=false)
     */
    private $compteLogin;

    /**
     * @var integer
     *
     * @ORM\Column(name="typeReaction", type="integer", nullable=false)
     */
    private $typeReaction;

    /**
     * @return mixed
     */
    public function getIdReaction()
    {
        return $this->idReaction;
    }

    /**
     * @param mixed $idReaction
     */
    public function setIdReaction($idReaction): void
    {
        $this->idReaction = $idReaction;
    }

    /**
     * @return mixed
     */
    public function getIDEvent()
    {
        return $this->ID_Event;
    }

    /**
     * @param mixed $ID_Event
     */
    public function setIDEvent($ID_Event): void
    {
        $this->ID_Event = $ID_Event;
    }

    /**
     * @return int
     */
    public function getCompteLogin(): int
    {
        return $this->compteLogin;
    }

    /**
     * @param int $compteLogin
     */
    public function setCompteLogin(int $compteLogin): void
    {
        $this->compteLogin = $compteLogin;
    }

    /**
     * @return int
     */
    public function getTypeReaction(): int
    {
        return $this->typeReaction;
    }

    /**
     * @param int $typeReaction
     */
    public function setTypeReaction(int $typeReaction): void
    {
        $this->typeReaction = $typeReaction;
    }



}
