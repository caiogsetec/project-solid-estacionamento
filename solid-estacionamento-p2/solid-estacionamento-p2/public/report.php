<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Infra\Repositories\SQLiteParkingRepository;

$repo = new SQLiteParkingRepository();

$types = [
    'car' => 'Carro',
    'moto' => 'Moto',
    'truck' => 'Caminhão'
];

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Faturamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 450px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background: #eee;
        }
    </style>
</head>
<body>

<h1>Relatório de Faturamento</h1>

<table>
    <tr>
        <th>Tipo de Veículo</th>
        <th>Total de Saídas</th>
        <th>Faturamento (R$)</th>
    </tr>

    <?php foreach ($types as $type => $label): ?>
        <tr>
            <td><?= $label ?></td>
            <td><?= $repo->countCompletedByType($type) ?></td>
            <td><?= number_format($repo->sumRevenueByType($type), 2, ',', '.') ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<br>

<a href="index.php">← Voltar</a>

</body>
</html>
