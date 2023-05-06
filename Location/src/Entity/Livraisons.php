<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Livraisons
 *
 * @ORM\Table(name="livraisons")
 * @ORM\Entity
 */
class Livraisons
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_livraison", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLivraison;

    /**
     * @var int
     *
     * @ORM\Column(name="cin_client", type="integer", nullable=false)
     */
    private $cinClient;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cin_livreur", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cinLivreur = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="depart_liv", type="string", length=30, nullable=false)
     */
    private $departLiv;

    /**
     * @var string
     *
     * @ORM\Column(name="dest_liv", type="string", length=20, nullable=false)
     */
    private $destLiv;

    /**
     * @var string
     *
     * @ORM\Column(name="image_pr", type="string", length=200, nullable=false)
     */
    private $imagePr;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_liv", type="date", nullable=false)
     */
    private $dateLiv;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_liv", type="string", length=20, nullable=false)
     */
    private $etatLiv;

    /**
     * @var int
     *
     * @ORM\Column(name="ref", type="integer", nullable=false)
     */
    private $ref;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mail_liv", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $mailLiv = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float", precision=10, scale=0, nullable=false)
     */
    private $poids;

    public function getIdLivraison(): ?int
    {
        return $this->idLivraison;
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

    public function getCinLivreur(): ?int
    {
        return $this->cinLivreur;
    }

    public function setCinLivreur(?int $cinLivreur): self
    {
        $this->cinLivreur = $cinLivreur;

        return $this;
    }

    public function getDepartLiv(): ?string
    {
        return $this->departLiv;
    }

    public function setDepartLiv(string $departLiv): self
    {
        $this->departLiv = $departLiv;

        return $this;
    }

    public function getDestLiv(): ?string
    {
        return $this->destLiv;
    }

    public function setDestLiv(string $destLiv): self
    {
        $this->destLiv = $destLiv;

        return $this;
    }

    public function getImagePr(): ?string
    {
        return $this->imagePr;
    }

    public function setImagePr(string $imagePr): self
    {
        $this->imagePr = $imagePr;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateLiv(): ?\DateTimeInterface
    {
        return $this->dateLiv;
    }

    public function setDateLiv(\DateTimeInterface $dateLiv): self
    {
        $this->dateLiv = $dateLiv;

        return $this;
    }

    public function getEtatLiv(): ?string
    {
        return $this->etatLiv;
    }

    public function setEtatLiv(string $etatLiv): self
    {
        $this->etatLiv = $etatLiv;

        return $this;
    }

    public function getRef(): ?int
    {
        return $this->ref;
    }

    public function setRef(int $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getMailLiv(): ?string
    {
        return $this->mailLiv;
    }

    public function setMailLiv(?string $mailLiv): self
    {
        $this->mailLiv = $mailLiv;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }


}
