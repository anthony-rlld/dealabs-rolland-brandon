<?php

namespace App\Entity;

use App\Repository\PromotionnalCodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionnalCodeRepository::class)
 */
class PromotionnalCode extends Deal
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reductionType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    public function getReductionType(): ?string
    {
        return $this->reductionType;
    }

    public function setReductionType(string $reductionType): self
    {
        $this->reductionType = $reductionType;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
