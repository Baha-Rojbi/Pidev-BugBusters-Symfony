<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chauffeurs
 *
 * @ORM\Table(name="chauffeurs")
 * @ORM\Entity
 */
class Chauffeurs
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
     * @var string
     *
     * @ORM\Column(name="image_permis", type="string", length=255, nullable=false)
     */
    private $imagePermis;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule_voiture", type="string", length=255, nullable=false)
     */
    private $matriculeVoiture;

    /**
     * @var string
     *
     * @ORM\Column(name="email_client", type="string", length=255, nullable=false)
     */
    private $emailClient;

    /**
     * @var string
     *
     * @ORM\Column(name="pass_client", type="string", length=255, nullable=false)
     */
    private $passClient;

    /**
     * @var int
     *
     * @ORM\Column(name="permis_chauf", type="integer", nullable=false)
     */
    private $permisChauf;

    /**
     * @var int
     *
     * @ORM\Column(name="Dispo", type="integer", nullable=false)
     */
    private $dispo;

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

    public function getImagePermis(): ?string
    {
        return $this->imagePermis;
    }

    public function setImagePermis(string $imagePermis): self
    {
        $this->imagePermis = $imagePermis;

        return $this;
    }

    public function getMatriculeVoiture(): ?string
    {
        return $this->matriculeVoiture;
    }

    public function setMatriculeVoiture(string $matriculeVoiture): self
    {
        $this->matriculeVoiture = $matriculeVoiture;

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

    public function getPermisChauf(): ?int
    {
        return $this->permisChauf;
    }

    public function setPermisChauf(int $permisChauf): self
    {
        $this->permisChauf = $permisChauf;

        return $this;
    }

    public function getDispo(): ?int
    {
        return $this->dispo;
    }

    public function setDispo(int $dispo): self
    {
        $this->dispo = $dispo;

        return $this;
    }


}
