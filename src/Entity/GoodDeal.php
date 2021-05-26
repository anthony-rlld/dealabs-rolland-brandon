<?php

namespace App\Entity;

use App\Repository\GoodDealRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GoodDealRepository::class)
 */
class GoodDeal extends Deal
{

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $actualPrice;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $newPrice;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $freeDelivery;

    public function getActualPrice(): ?float
    {
        return $this->actualPrice;
    }

    public function setActualPrice(?float $actualPrice): self
    {
        $this->actualPrice = $actualPrice;

        return $this;
    }

    public function getNewPrice(): ?float
    {
        return $this->newPrice;
    }

    public function setNewPrice(?float $newPrice): self
    {
        $this->newPrice = $newPrice;

        return $this;
    }

    public function getFreeDelivery(): ?bool
    {
        return $this->freeDelivery;
    }

    public function setFreeDelivery(?bool $freeDelivery): self
    {
        $this->freeDelivery = $freeDelivery;

        return $this;
    }
}
