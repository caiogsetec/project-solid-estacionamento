<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Application\Services\CheckinService;
use App\Infra\Repositories\SQLiteParkingRepository;

if ($_POST) {
    $service = new CheckinService(new SQLiteParkingRepository());
    $service->execute($_POST['plate'], $_POST['type']);
    echo "Check-in realizado!";
}
?>

<h1>Check-in</h1>
<form method="POST">
    Placa: <input name="plate"><br>
    Tipo:
    <select name="type">
        <option value="car">Carro</option>
        <option value="moto">Moto</option>
        <option value="truck">Caminhão</option>
    </select>
    <br>
    <button type="submit">Enviar</button><br>
    <a href="index.php">Voltar</a>
</form>
