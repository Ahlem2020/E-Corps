<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentairee
 *
 * @ORM\Table(name="commentairee", indexes={@ORM\Index(name="CommentEvent", columns={"ID_Event"}), @ORM\Index(name="CommentUser", columns={"compteLogin"})})
 * @ORM\Entity
 */
class Commentairee
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_C", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idC;

    /**
     * @var string
     *
     * @ORM\Column(name="Message", type="text", length=0, nullable=false)
     */
    private $message;

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

    public function getIdC(): ?int
    {
        return $this->idC;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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
