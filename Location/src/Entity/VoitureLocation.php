<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VoitureLocationRepository;


/**
 * VoitureLocation
 *
 * @ORM\Table(name="voiture_location")
 * @ORM\Entity(repositoryClass=VoitureLocationRepository::class)
 */

class VoitureLocation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_voiture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="carte_grise", type="string", length=255, nullable=false)
     */
    private $carteGrise;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_jour", type="integer", nullable=false)
     */
    private $prixJour;

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

    public function getIdVoiture(): ?int
    {
        return $this->idVoiture;
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

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getCarteGrise(): ?string
    {
        return $this->carteGrise;
    }

    public function setCarteGrise(string $carteGrise): self
    {
        $this->carteGrise = $carteGrise;

        return $this;
    }

    public function getPrixJour(): ?int
    {
        return $this->prixJour;
    }

    public function setPrixJour(int $prixJour): self
    {
        $this->prixJour = $prixJour;

        return $this;
    }

    public function getImageVoiture(): ?string
    {
        return $this->imageVoiture;
    }

    public function setImageVoiture(string $imageVoiture): self
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
