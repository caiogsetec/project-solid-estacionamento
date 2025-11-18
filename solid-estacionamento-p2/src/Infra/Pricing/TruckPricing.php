<?php
namespace App\Infra\Pricing;

class TruckPricing implements PricingStrategy
{
    public function calculate(float $hours): float
    {
        return 10.0 * $hours; 
    }
}
