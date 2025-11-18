<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Application\Services\CheckoutService;
use App\Infra\Repositories\SQLiteParkingRepository;

if ($_POST) {

    try {
        $service = new CheckoutService(new SQLiteParkingRepository());
        $price = $service->execute($_POST['plate']);
        echo "Check-out realizado! Valor a pagar: R$ $price";
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}
?>

<h1>Check-out</h1>
<form method="POST">
    Placa: <input name="plate">
    <button>Finalizar</button><br>
    <a href="index.php">Voltar</a>
</form>
