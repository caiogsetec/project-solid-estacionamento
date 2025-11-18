<?php
namespace App\Infra\Pricing;

class CarPricing implements PricingStrategy
{
    public function calculate(float $hours): float
    {
        return 5.0 * $hours; 
    }
}
