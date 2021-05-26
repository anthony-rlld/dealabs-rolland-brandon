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
}
