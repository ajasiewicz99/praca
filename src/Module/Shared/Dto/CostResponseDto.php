<?php

namespace App\Module\Shared\Dto;

class CostResponseDto
{
    public float $costsNet;
    public float $vatToReduce;

    public function __construct(float $costsNet, float $vatToReduce) {
        $this->costsNet = round($costsNet,2);
        $this->vatToReduce = round($vatToReduce,2);
    }
}
