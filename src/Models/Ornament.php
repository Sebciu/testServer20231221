<?php

namespace Src\Models;

class Ornament
{
    private int $id;
    private string $type;
    private float $netPricePLN;
    private float $netPriceEuro;
    private int $sizeId;
    private float $vat;

    public function __construct(int $id, string $type, float $netPricePLN = 0, float $netPriceEuro = 0, int $sizeId, float $vat = 0.23)
    {
        $this->id = $id;
        $this->type = $type;
        $this->netPricePLN = $netPricePLN;
        $this->netPriceEuro = $netPriceEuro;
        $this->sizeId = $sizeId;
        $this->vat = $vat;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }


    public function getNetPricePLN(): float
    {
        return $this->netPricePLN;
    }

    public function getNetPriceEuro(): float
    {
        return $this->netPriceEuro;
    }
    public function getTotalPricePLN(): float
    {
        return round($this->netPricePLN*(1+$this->vat),2);
    }

    public function getTotalPriceEuro(): float
    {
        return round($this->netPriceEuro*(1+$this->vat),2);
    }

    public function getSizeId(): int
    {
        return $this->sizeId;
    }
}