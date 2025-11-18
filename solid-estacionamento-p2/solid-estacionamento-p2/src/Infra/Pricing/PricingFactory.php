<?php
namespace App\Infra\Pricing;

class PricingFactory
{
    public static function make(string $type): PricingStrategy
    {
        return match ($type) {
            'car' => new CarPricing(),
            'moto' => new MotoPricing(),
            'truck' => new TruckPricing(),
            default => throw new \Exception("Tipo inválido: $type")
        };
    }
}
