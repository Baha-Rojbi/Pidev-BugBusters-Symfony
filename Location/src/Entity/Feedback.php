<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback", indexes={@ORM\Index(name="id_livr", columns={"id_livr"})})
 * @ORM\Entity
 */
class Feedback
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_feedback", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFeedback;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_feedback", type="string", length=255, nullable=false)
     */
    private $descFeedback;

    /**
     * @var int
     *
     * @ORM\Column(name="rate", type="integer", nullable=false)
     */
    private $rate;

    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;

    /**
     * @var int
     *
     * @ORM\Column(name="id_livr", type="integer", nullable=false)
     */
    private $idLivr;

    public function getIdFeedback(): ?int
    {
        return $this->idFeedback;
    }

    public function getDescFeedback(): ?string
    {
        return $this->descFeedback;
    }

    public function setDescFeedback(string $descFeedback): self
    {
        $this->descFeedback = $descFeedback;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

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

    public function getIdLivr(): ?int
    {
        return $this->idLivr;
    }

    public function setIdLivr(int $idLivr): self
    {
        $this->idLivr = $idLivr;

        return $this;
    }


}
