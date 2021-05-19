<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoteRepository::class)
 */
class Vote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $notation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="votesList")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity=Deal::class, inversedBy="votesList")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dealId;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNotation(): ?int
    {
        return $this->notation;
    }

    public function setNotation(int $notation): self
    {
        $this->notation = $notation;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getDealId(): ?Deal
    {
        return $this->dealId;
    }

    public function setDealId(?Deal $dealId): self
    {
        $this->dealId = $dealId;

        return $this;
    }
}
