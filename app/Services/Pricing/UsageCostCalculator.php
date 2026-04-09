<?php

namespace App\Services\Pricing;

class UsageCostCalculator
{
    /**
     * Custo estimado em USD a partir de preço por 1M tokens (input/output) e uso.
     *
     * @param  array{cost: array{input_usd_per_million: float, output_usd_per_million: float}}  $model
     * @param  int  $promptTokens
     * @param  int  $completionTokens
     * @return array{total: float}
     */
    public function calculate(array $model, int $promptTokens, int $completionTokens): float
    {
        $inRate = (float) $model['cost']['input_usd_per_million'];
        $outRate = (float) $model['cost']['output_usd_per_million'];

        $inputUsd = ($promptTokens / 1_000_000) * $inRate;
        $outputUsd = ($completionTokens / 1_000_000) * $outRate;

        return round($inputUsd + $outputUsd, 10);
    }
}
