<?php

namespace Src\Models;

class Tree
{
    private int $id;
    private string $name;
    private int $size;
    private array $excludedOrnamentSizes;
    private float $netPricePLN;
    private float $netPriceEuro;
    private float $vat;

    public function __construct(int $id, string $name, int $size, array $excludedOrnamentSizes, float $netPricePLN = 0, float $netPriceEuro = 0, float $vat = 0.23)
    {
        $this->id = $id;
        $this->name = $name;
        $this->size = $size;
        $this->excludedOrnamentSizes = $excludedOrnamentSizes;
        $this->netPricePLN = $netPricePLN;
        $this->netPriceEuro = $netPriceEuro;
        $this->vat = $vat;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getExcludedOrnamentSizes(): array
    {
        return $this->excludedOrnamentSizes;
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
}