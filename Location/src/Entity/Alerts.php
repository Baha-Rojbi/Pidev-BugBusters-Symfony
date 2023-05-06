<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alerts
 *
 * @ORM\Table(name="alerts", indexes={@ORM\Index(name="id_annonce", columns={"id_annonce"})})
 * @ORM\Entity
 */
class Alerts
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_alerts", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAlerts;

    /**
     * @var int
     *
     * @ORM\Column(name="id_annonce", type="integer", nullable=false)
     */
    private $idAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=30, nullable=false)
     */
    private $destination;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $date = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="rapport", type="string", length=150, nullable=false)
     */
    private $rapport;

    /**
     * @var int
     *
     * @ORM\Column(name="Num_tel", type="integer", nullable=false)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=100, nullable=false)
     */
    private $mail;

    public function getIdAlerts(): ?int
    {
        return $this->idAlerts;
    }

    public function getIdAnnonce(): ?int
    {
        return $this->idAnnonce;
    }

    public function setIdAnnonce(int $idAnnonce): self
    {
        $this->idAnnonce = $idAnnonce;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRapport(): ?string
    {
        return $this->rapport;
    }

    public function setRapport(string $rapport): self
    {
        $this->rapport = $rapport;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->numTel;
    }

    public function setNumTel(int $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }


}
