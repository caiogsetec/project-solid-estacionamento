<?php
namespace App\Infra\Pricing;

class MotoPricing implements PricingStrategy
{
    public function calculate(float $hours): float
    {
        return 3.0 * $hours; 
    }
}
