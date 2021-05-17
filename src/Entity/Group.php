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
     * @ORM\ManyToMany(targetEntity=Deal::class, mappedBy="groupsList")
     */
    private $dealsList;

    public function __construct()
    {
        $this->dealsList = new ArrayCollection();
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
    public function getDealsList(): Collection
    {
        return $this->dealsList;
    }

    public function addDealsList(Deal $dealsList): self
    {
        if (!$this->dealsList->contains($dealsList)) {
            $this->dealsList[] = $dealsList;
            $dealsList->addGroupsList($this);
        }

        return $this;
    }

    public function removeDealsList(Deal $dealsList): self
    {
        if ($this->dealsList->removeElement($dealsList)) {
            $dealsList->removeGroupsList($this);
        }

        return $this;
    }
}
