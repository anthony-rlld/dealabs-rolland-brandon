<?php

namespace App\Entity;

use App\Repository\DealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * @ORM\Entity(repositoryClass=DealRepository::class)
 * @MappedSuperclass
 */
class Deal
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $degree;

    /**
     * @ORM\Column(type="integer")
     */

    private $groupsList;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="dealId", orphanRemoval=true)
     */
    private $commentsList;

    /**
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="dealId", orphanRemoval=true)
     */
    private $votesList;

    /**
     * @ORM\ManyToOne(targetEntity=Website::class, inversedBy="dealsList")
     */
    private $websiteId;

    public function __construct()
    {
        $this->groupsList = new ArrayCollection();
        $this->commentsList = new ArrayCollection();
        $this->votesList = new ArrayCollection();
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
     * @return Collection|Group[]
     */
    public function getGroupsList(): Collection
    {
        return $this->groupsList;
    }

    public function addGroupsList(Group $groupsList): self
    {
        if (!$this->groupsList->contains($groupsList)) {
            $this->groupsList[] = $groupsList;
        }

        return $this;
    }

    public function removeGroupsList(Group $groupsList): self
    {
        $this->groupsList->removeElement($groupsList);

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
            $commentsList->setDealId($this);
        }

        return $this;
    }

    public function removeCommentsList(Comment $commentsList): self
    {
        if ($this->commentsList->removeElement($commentsList)) {
            // set the owning side to null (unless already changed)
            if ($commentsList->getDealId() === $this) {
                $commentsList->setDealId(null);
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
            $votesList->setDealId($this);
        }

        return $this;
    }

    public function removeVotesList(Vote $votesList): self
    {
        if ($this->votesList->removeElement($votesList)) {
            // set the owning side to null (unless already changed)
            if ($votesList->getDealId() === $this) {
                $votesList->setDealId(null);
            }
        }

        return $this;
    }

    public function getWebsiteId(): ?Website
    {
        return $this->websiteId;
    }

    public function setWebsiteId(?Website $websiteId): self
    {
        $this->websiteId = $websiteId;

        return $this;
    }
}
