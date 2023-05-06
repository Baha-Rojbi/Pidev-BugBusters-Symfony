<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity
 */
class Annonce
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_annonce", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="date_annonce", type="string", length=20, nullable=false)
     */
    private $dateAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="destination_annonce", type="string", length=30, nullable=false)
     */
    private $destinationAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="depart_annonce", type="string", length=40, nullable=false)
     */
    private $departAnnonce;

    /**
     * @var int
     *
     * @ORM\Column(name="dispo_annonce", type="integer", nullable=false)
     */
    private $dispoAnnonce;

    /**
     * @var int
     *
     * @ORM\Column(name="Num_tel", type="integer", nullable=false)
     */
    private $numTel;

    /**
     * @var int
     *
     * @ORM\Column(name="Ref_annonce", type="integer", nullable=false)
     */
    private $refAnnonce;

    /**
     * @var int
     *
     * @ORM\Column(name="id_chauff", type="integer", nullable=false)
     */
    private $idChauff;

    /**
     * @var string
     *
     * @ORM\Column(name="Image_name", type="string", length=255, nullable=false)
     */
    private $imageName;

    public function getIdAnnonce(): ?int
    {
        return $this->idAnnonce;
    }

    public function getDateAnnonce(): ?string
    {
        return $this->dateAnnonce;
    }

    public function setDateAnnonce(string $dateAnnonce): self
    {
        $this->dateAnnonce = $dateAnnonce;

        return $this;
    }

    public function getDestinationAnnonce(): ?string
    {
        return $this->destinationAnnonce;
    }

    public function setDestinationAnnonce(string $destinationAnnonce): self
    {
        $this->destinationAnnonce = $destinationAnnonce;

        return $this;
    }

    public function getDepartAnnonce(): ?string
    {
        return $this->departAnnonce;
    }

    public function setDepartAnnonce(string $departAnnonce): self
    {
        $this->departAnnonce = $departAnnonce;

        return $this;
    }

    public function getDispoAnnonce(): ?int
    {
        return $this->dispoAnnonce;
    }

    public function setDispoAnnonce(int $dispoAnnonce): self
    {
        $this->dispoAnnonce = $dispoAnnonce;

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

    public function getRefAnnonce(): ?int
    {
        return $this->refAnnonce;
    }

    public function setRefAnnonce(int $refAnnonce): self
    {
        $this->refAnnonce = $refAnnonce;

        return $this;
    }

    public function getIdChauff(): ?int
    {
        return $this->idChauff;
    }

    public function setIdChauff(int $idChauff): self
    {
        $this->idChauff = $idChauff;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }


}
