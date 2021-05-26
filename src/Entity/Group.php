<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Deal::class, mappedBy="groupList")
     */
    private $dealList;

    public function __construct()
    {
        $this->dealList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Deal[]
     */
    public function getDealList(): Collection
    {
        return $this->dealList;
    }

    public function addDealList(Deal $dealList): self
    {
        if (!$this->dealList->contains($dealList)) {
            $this->dealList[] = $dealList;
            $dealList->addGroupList($this);
        }

        return $this;
    }

    public function removeDealList(Deal $dealList): self
    {
        if ($this->dealList->removeElement($dealList)) {
            $dealList->removeGroupList($this);
        }

        return $this;
    }
}
