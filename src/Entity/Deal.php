<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DealRepository")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"goodDeal" = "GoodDeal", "promotionnalCode" = "PromotionnalCode"})
 */
abstract class Deal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="date")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="integer", nullable=true,)
     */
    private $degree;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="deal", orphanRemoval=true)
     */
    private $commentsList;

    /**
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="deal", orphanRemoval=true)
     */
    private $votesList;

    /**
     * @ORM\ManyToMany(targetEntity=Group::class, inversedBy="dealList")
     */
    private $groupList;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="deals")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;


    public function __construct()
    {
        $this->commentsList = new ArrayCollection();
        $this->votesList = new ArrayCollection();
        $this->groupList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }


    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getDegree(): ?int
    {
        return $this->degree;
    }

    public function setDegree(?int $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getCommentsList(): Collection
    {
        return $this->commentsList;
    }

    public function addCommentsList(Comment $commentsList): self
    {
        if (!$this->commentsList->contains($commentsList)) {
            $this->commentsList[] = $commentsList;
            $commentsList->setDeal($this);
        }

        return $this;
    }

    public function removeCommentsList(Comment $commentsList): self
    {
        if ($this->commentsList->removeElement($commentsList)) {
            // set the owning side to null (unless already changed)
            if ($commentsList->getDeal() === $this) {
                $commentsList->setDeal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotesList(): Collection
    {
        return $this->votesList;
    }

    public function addVotesList(Vote $votesList): self
    {
        if (!$this->votesList->contains($votesList)) {
            $this->votesList[] = $votesList;
            $votesList->setDeal($this);
        }

        return $this;
    }

    public function removeVotesList(Vote $votesList): self
    {
        if ($this->votesList->removeElement($votesList)) {
            // set the owning side to null (unless already changed)
            if ($votesList->getDeal() === $this) {
                $votesList->setDeal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroupList(): Collection
    {
        return $this->groupList;
    }

    public function addGroupList(Group $groupList): self
    {
        if (!$this->groupList->contains($groupList)) {
            $this->groupList[] = $groupList;
        }

        return $this;
    }

    public function removeGroupList(Group $groupList): self
    {
        $this->groupList->removeElement($groupList);

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

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
}
