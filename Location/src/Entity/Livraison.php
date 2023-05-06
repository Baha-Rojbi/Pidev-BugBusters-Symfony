<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison", indexes={@ORM\Index(name="id_client", columns={"id_client"})})
 * @ORM\Entity
 */
class Livraison
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_livr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLivr;

    /**
     * @var string
     *
     * @ORM\Column(name="destination_livr", type="string", length=15, nullable=false)
     */
    private $destinationLivr;

    /**
     * @var string
     *
     * @ORM\Column(name="depart_livr", type="string", length=30, nullable=false)
     */
    private $departLivr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_livr", type="date", nullable=false)
     */
    private $dateLivr;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_livr", type="string", length=30, nullable=false)
     */
    private $etatLivr;

    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;

    public function getIdLivr(): ?int
    {
        return $this->idLivr;
    }

    public function getDestinationLivr(): ?string
    {
        return $this->destinationLivr;
    }

    public function setDestinationLivr(string $destinationLivr): self
    {
        $this->destinationLivr = $destinationLivr;

        return $this;
    }

    public function getDepartLivr(): ?string
    {
        return $this->departLivr;
    }

    public function setDepartLivr(string $departLivr): self
    {
        $this->departLivr = $departLivr;

        return $this;
    }

    public function getDateLivr(): ?\DateTimeInterface
    {
        return $this->dateLivr;
    }

    public function setDateLivr(\DateTimeInterface $dateLivr): self
    {
        $this->dateLivr = $dateLivr;

        return $this;
    }

    public function getEtatLivr(): ?string
    {
        return $this->etatLivr;
    }

    public function setEtatLivr(string $etatLivr): self
    {
        $this->etatLivr = $etatLivr;

        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function setIdClient(int $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }


}
