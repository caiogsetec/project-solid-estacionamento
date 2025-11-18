<?php
namespace App\Infra\Repositories;

use App\Domain\ParkingRecord;

interface ParkingRepositoryInterface
{
    public function checkin(ParkingRecord $record): void;
    public function findActiveByPlate(string $plate): ?ParkingRecord;
    public function checkout(ParkingRecord $record): void;

    public function findCompletedByType(string $type): array;
    public function countCompletedByType(string $type): int;
    public function sumRevenueByType(string $type): float;
}
