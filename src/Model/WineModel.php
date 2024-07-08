<?php

declare(strict_types=1);

namespace Saeed\Winecalculator\Model;


class WineModel
{
    public function __construct(private string $sku, private float $price, private string $packageType)
    {
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPackageType(): string
    {
        return $this->packageType;
    }
}
