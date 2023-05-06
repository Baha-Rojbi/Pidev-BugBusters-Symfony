<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * ChatMessages
 *
 * @ORM\Table(name="chat_messages")
 * @ORM\Entity
 */
class ChatMessages
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=false)
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="sender_id", type="integer", nullable=false)
     */
    private $senderId;

    /**
     * @var int
     *
     * @ORM\Column(name="receiver_id", type="integer", nullable=false)
     */
    private $receiverId;

    /**
     * @var int
     *
     * @ORM\Column(name="delivery_id", type="integer", nullable=false)
     */
    private $deliveryId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $createdDate = 'current_timestamp()';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSenderId(): ?int
    {
        return $this->senderId;
    }

    public function setSenderId(int $senderId): self
    {
        $this->senderId = $senderId;

        return $this;
    }

    public function getReceiverId(): ?int
    {
        return $this->receiverId;
    }

    public function setReceiverId(int $receiverId): self
    {
        $this->receiverId = $receiverId;

        return $this;
    }

    public function getDeliveryId(): ?int
    {
        return $this->deliveryId;
    }

    public function setDeliveryId(int $deliveryId): self
    {
        $this->deliveryId = $deliveryId;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }


}
