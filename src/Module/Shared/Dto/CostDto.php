<?php

namespace App\Module\Shared\Dto;

class CostDto
{
    public float $priceNet;
    public int $vatRate;
    public int $quantity;
    public int $possiblyDeduction;

    public function __construct(float $priceNet, int $vatRate, int $quantity, int $possiblyDeduction) {
        $this->priceNet = $priceNet;
        $this->vatRate = $vatRate;
        $this->quantity = $quantity;
        $this->possiblyDeduction = $possiblyDeduction;
    }
}
