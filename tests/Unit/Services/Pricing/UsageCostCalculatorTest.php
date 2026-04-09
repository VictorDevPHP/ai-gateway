<?php

namespace Tests\Unit\Services\Pricing;

use App\Services\Pricing\UsageCostCalculator;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UsageCostCalculatorTest extends TestCase
{
    #[Test]
    public function it_calculates_total_from_per_million_rates_and_token_counts(): void
    {
        $calc = new UsageCostCalculator;

        $result = $calc->calculate(
            [
                'cost' => [
                    'input_usd_per_million' => 0.05,
                    'output_usd_per_million' => 0.08,
                ],
            ],
            1_000_000,
            1_000_000,
        );

        $this->assertSame(0.13, $result);
    }

    #[Test]
    public function it_handles_zero_tokens(): void
    {
        $calc = new UsageCostCalculator;

        $result = $calc->calculate(
            [
                'cost' => [
                    'input_usd_per_million' => 0.10,
                    'output_usd_per_million' => 0.20,
                ],
            ],
            0,
            0,
        );

        $this->assertSame(0.0, $result);
    }
}
