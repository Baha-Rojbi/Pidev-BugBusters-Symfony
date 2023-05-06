<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LocationRepository;

/**
 * Location
 *
 * @ORM\Table(name="location", indexes={@ORM\Index(name="id_voiture", columns={"id_voiture"})})
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_location", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLocation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_location", type="integer", nullable=false)
     */
    private $prixLocation;

    /**
     * @var int
     *
     * @ORM\Column(name="id_voiture", type="integer", nullable=false)
     */
    private $idVoiture;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=255, nullable=false)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255, nullable=false)
     */
    private $modele;

    /**
     * @var string
     *
     * @ORM\Column(name="image_voiture", type="string", length=255, nullable=false)
     */
    private $imageVoiture;

    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VoitureLocation")
     * @ORM\JoinColumn(name="id_voiture", referencedColumnName="id_voiture")
     */
    private $voitureLocation;

    public function getVoitureLocation(): ?VoitureLocation
    {
        return $this->voitureLocation;
    }

    public function setVoitureLocation(?VoitureLocation $voitureLocation): self
    {
        $this->voitureLocation = $voitureLocation;

        return $this;
    }

    public function getIdLocation(): ?int
    {
        return $this->idLocation;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getPrixLocation(): ?int
    {
        return $this->prixLocation;
    }

    public function setPrixLocation(int $prixLocation): self
    {
        $this->prixLocation = $prixLocation;

        return $this;
    }

    public function getIdVoiture(): ?int
    {
        return $this->idVoiture;
    }

    public function setIdVoiture(int $idVoiture): self
    {
        $this->idVoiture = $idVoiture;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public
    function setModele(string $modele): self
    {
        $this->modele = $modele;
        return $this;
    }

    public function getImageVoiture()
    {
        return $this->imageVoiture;
    }

    public function setImageVoiture($imageVoiture): self
    {
        $this->imageVoiture = $imageVoiture;

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
