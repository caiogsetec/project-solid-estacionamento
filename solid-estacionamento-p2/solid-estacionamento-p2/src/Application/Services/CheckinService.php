<?php
namespace App\Application\Services;

use App\Domain\ParkingRecord;
use App\Infra\Repositories\ParkingRepositoryInterface;

class CheckinService
{
    public function __construct(private ParkingRepositoryInterface $repo) {}

    public function execute(string $plate, string $type): void
    {
        $record = new ParkingRecord(
            id: null,
            plate: $plate,
            type: $type,
            entry_time: date('Y-m-d H:i:s'),
            exit_time: null,
            price: null
        );

        $this->repo->checkin($record);
    }
}
