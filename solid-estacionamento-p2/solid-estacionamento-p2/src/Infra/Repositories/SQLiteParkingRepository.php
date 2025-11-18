<?php
namespace App\Infra\Repositories;

use App\Domain\ParkingRecord;
use App\Infra\Database\Connection;

class SQLiteParkingRepository implements ParkingRepositoryInterface
{
    public function checkin(ParkingRecord $record): void
    {
        $db = Connection::get();
        $stmt = $db->prepare("
            INSERT INTO parking_records (plate, type, entry_time)
            VALUES (:plate, :type, :entry)
        ");

        // salva placa em uppercase para consistência
        $stmt->bindValue(':plate', strtoupper($record->plate));
        $stmt->bindValue(':type', $record->type);
        $stmt->bindValue(':entry', $record->entry_time);

        if (!$stmt->execute()) {
            throw new \RuntimeException('Erro ao inserir checkin no banco.');
        }
    }

    public function findActiveByPlate(string $plate): ?ParkingRecord
    {
        $db = Connection::get();
        $stmt = $db->prepare("
            SELECT * FROM parking_records 
            WHERE plate = :plate AND exit_time IS NULL
            LIMIT 1
        ");

        $stmt->bindValue(':plate', strtoupper($plate));
        $res = $stmt->execute();
        $result = $res ? $res->fetchArray(SQLITE3_ASSOC) : false;

        if (!$result) {
            return null;
        }

        // garante que índices existam antes de criar a entidade
        return new ParkingRecord(
            $result['id'] ?? null,
            $result['plate'] ?? null,
            $result['type'] ?? null,
            $result['entry_time'] ?? null,
            $result['exit_time'] ?? null,
            $result['price'] ?? null
        );
    }

    public function checkout(ParkingRecord $record): void
    {
        if (empty($record->id)) {
            throw new \InvalidArgumentException('Registro inválido para checkout (id ausente).');
        }

        $db = Connection::get();
        $stmt = $db->prepare("
            UPDATE parking_records
            SET exit_time = :exit, price = :price
            WHERE id = :id
        ");

        $stmt->bindValue(':exit', $record->exit_time);
        $stmt->bindValue(':price', $record->price);
        $stmt->bindValue(':id', $record->id, SQLITE3_INTEGER);

        if (!$stmt->execute()) {
            throw new \RuntimeException('Erro ao registrar checkout no banco.');
        }
    }

    public function findCompletedByType(string $type): array
    {
        $db = Connection::get();
        $stmt = $db->prepare("
            SELECT * FROM parking_records
            WHERE type = :type AND exit_time IS NOT NULL
        ");

        $stmt->bindValue(':type', $type);
        $results = $stmt->execute();

        $records = [];

        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $records[] = new ParkingRecord(
                $row['id'],
                $row['plate'],
                $row['type'],
                $row['entry_time'],
                $row['exit_time'],
                $row['price']
            );
        }

        return $records;
    }

    public function countCompletedByType(string $type): int
    {
        $db = Connection::get();
        $stmt = $db->prepare("
            SELECT COUNT(*) AS total
            FROM parking_records
            WHERE type = :type AND exit_time IS NOT NULL
        ");

        $stmt->bindValue(':type', $type);
        $res = $stmt->execute();
        $result = $res ? $res->fetchArray(SQLITE3_ASSOC) : false;

        return isset($result['total']) ? (int)$result['total'] : 0;
    }

    public function sumRevenueByType(string $type): float
    {
        $db = Connection::get();
        $stmt = $db->prepare("
            SELECT SUM(price) AS total
            FROM parking_records
            WHERE type = :type AND exit_time IS NOT NULL
        ");

        $stmt->bindValue(':type', $type);
        $res = $stmt->execute();
        $result = $res ? $res->fetchArray(SQLITE3_ASSOC) : false;

        return ($result && $result['total'] !== null) ? (float)$result['total'] : 0.0;
    }
}
