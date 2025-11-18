<?php
namespace App\Domain;

class ParkingRecord
{
    public function __construct(
        public ?int $id,
        public string $plate,
        public string $type,
        public string $entry_time,
        public ?string $exit_time,
        public ?float $price
    ) {}
}
