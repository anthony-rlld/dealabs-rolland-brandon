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
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Deal::class, inversedBy="votesList")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deal;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDeal(): ?Deal
    {
        return $this->deal;
    }

    public function setDeal(?Deal $deal): self
    {
        $this->deal = $deal;

        return $this;
    }
}
