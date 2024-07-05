<?php

namespace App\Module\Shared\Dto;

class ZusDto
{
    public float $emergentTax;
    public float $pensionTax;
    public float $sickLeaveTax;
    public float $healthcareTax;
    public float $totalTax;

    public function __construct(
        float $emergentTax,
        float $pensionTax,
        float $sickLeaveTax,
        float $healthcareTax,
        float $totalTax
    ) {
        $this->emergentTax = $emergentTax;
        $this->pensionTax = $pensionTax;
        $this->sickLeaveTax = $sickLeaveTax;
        $this->healthcareTax = $healthcareTax;
        $this->totalTax = $totalTax;
    }
}
