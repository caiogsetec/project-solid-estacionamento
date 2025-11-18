<?php
namespace App\Infra\Pricing;

interface PricingStrategy
{
    public function calculate(float $hours): float;
}
