<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity
 */
class Voiture
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
     * @ORM\Column(name="matricule", type="string", length=30, nullable=false)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="image_grise", type="string", length=255, nullable=false)
     */
    private $imageGrise;

    /**
     * @var string
     *
     * @ORM\Column(name="image_voiture", type="string", length=255, nullable=false)
     */
    private $imageVoiture;

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

    public function getImageGrise(): ?string
    {
        return $this->imageGrise;
    }

    public function setImageGrise(string $imageGrise): self
    {
        $this->imageGrise = $imageGrise;

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


}
