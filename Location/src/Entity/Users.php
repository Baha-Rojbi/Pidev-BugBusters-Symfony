<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClient;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_client", type="string", length=255, nullable=false)
     */
    private $nomClient;

    /**
     * @var int
     *
     * @ORM\Column(name="cin_client", type="integer", nullable=false)
     */
    private $cinClient;

    /**
     * @var string
     *
     * @ORM\Column(name="email_client", type="string", length=50, nullable=false)
     */
    private $emailClient;

    /**
     * @var string
     *
     * @ORM\Column(name="pass_client", type="string", length=50, nullable=false)
     */
    private $passClient;

    /**
     * @var int
     *
     * @ORM\Column(name="role_client", type="integer", nullable=false, options={"default"="1"})
     */
    private $roleClient = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="ban", type="integer", nullable=false)
     */
    private $ban;

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getCinClient(): ?int
    {
        return $this->cinClient;
    }

    public function setCinClient(int $cinClient): self
    {
        $this->cinClient = $cinClient;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->emailClient;
    }

    public function setEmailClient(string $emailClient): self
    {
        $this->emailClient = $emailClient;

        return $this;
    }

    public function getPassClient(): ?string
    {
        return $this->passClient;
    }

    public function setPassClient(string $passClient): self
    {
        $this->passClient = $passClient;

        return $this;
    }

    public function getRoleClient(): ?int
    {
        return $this->roleClient;
    }

    public function setRoleClient(int $roleClient): self
    {
        $this->roleClient = $roleClient;

        return $this;
    }

    public function getBan(): ?int
    {
        return $this->ban;
    }

    public function setBan(int $ban): self
    {
        $this->ban = $ban;

        return $this;
    }


}
