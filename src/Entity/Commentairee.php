<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentairee
 *
 * @ORM\Table(name="commentairee", indexes={@ORM\Index(name="CommentEvent", columns={"ID_Event"})})
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
     * @ORM\Column(name="Comment", type="string", length=250, nullable=false)
     */
    private $comment;

    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity=Event::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Event", referencedColumnName="ID_Event")
     * })
     */
    private $idEvent;

    public function getIdC(): ?int
    {
        return $this->idC;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * @return \Event
     */
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
