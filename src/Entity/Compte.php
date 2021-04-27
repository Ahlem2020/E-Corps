<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compte
 *
 * @ORM\Table(name="compte")
 * @ORM\Entity
 */
class Compte
{
    /**
     * @var string
     *
     * @ORM\Column(name="compteLogin", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $comptelogin;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=20, nullable=false)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imgUrl", type="string", length=255, nullable=true)
     */
    private $imgurl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="aboutMe", type="string", length=255, nullable=true)
     */
    private $aboutme;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isClosed", type="boolean", nullable=true)
     */
    private $isclosed;

    /**
     * @var int
     *
     * @ORM\Column(name="persoID", type="integer", nullable=false)
     */
    private $persoid;

    public function getComptelogin(): ?string
    {
        return $this->comptelogin;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getImgurl(): ?string
    {
        return $this->imgurl;
    }

    public function setImgurl(?string $imgurl): self
    {
        $this->imgurl = $imgurl;

        return $this;
    }

    public function getAboutme(): ?string
    {
        return $this->aboutme;
    }

    public function setAboutme(?string $aboutme): self
    {
        $this->aboutme = $aboutme;

        return $this;
    }

    public function getIsclosed(): ?bool
    {
        return $this->isclosed;
    }

    public function setIsclosed(?bool $isclosed): self
    {
        $this->isclosed = $isclosed;

        return $this;
    }

    public function getPersoid(): ?int
    {
        return $this->persoid;
    }

    public function setPersoid(int $persoid): self
    {
        $this->persoid = $persoid;

        return $this;
    }


}
