<?php
namespace App\Application\Services;

use App\Infra\Repositories\ParkingRepositoryInterface;
use App\Infra\Pricing\PricingFactory;

class CheckoutService
{
    public function __construct(private ParkingRepositoryInterface $repo) {}
 
    public function execute(string $plate): float
    {
        $record = $this->repo->findActiveByPlate($plate);

        if (!$record) {
            throw new \Exception("Nenhum veículo ativo com essa placa.");
        }

        $entry = strtotime($record->entry_time);
        $exit = time();
        $hours = ceil(($exit - $entry) / 3600);

        $strategy = PricingFactory::make($record->type);
        $price = $strategy->calculate($hours);

        $record->exit_time = date('Y-m-d H:i:s');
        $record->price = $price;

        $this->repo->checkout($record);

        return $price;
    }
}
