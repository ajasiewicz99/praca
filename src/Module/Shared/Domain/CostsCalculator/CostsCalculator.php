<?php

namespace App\Module\Shared\Domain\CostsCalculator;

use App\Module\Shared\Dto\CostDto;
use App\Module\Shared\Dto\CostResponseDto;

class CostsCalculator
{
    public function count(array $costsDto): CostResponseDto
    {
        $totalNet = 0;
        $totalVatSaved = 0;
        /** @var CostDto $costDto */
        foreach ($costsDto as $costDto) {
            $totalNet+= $costDto->priceNet * $costDto->quantity;
            $payedVat = ($costDto->priceNet / 100 ) * $costDto->vatRate;

            $totalVatSaved+= $payedVat * ($costDto->possiblyDeduction / 100);
        }

        return new CostResponseDto(
            $totalNet,
            $totalVatSaved
        );
    }

    public function arrayToDto(array $data): CostDto
    {
        return new CostDto(
            $data['priceNet'] ?? 0,
            $data['vatRate'] ?? 0,
            $data['quantity'] ?? 0,
            $data['possiblyDeduction'] ?? 0
        );
    }
}
