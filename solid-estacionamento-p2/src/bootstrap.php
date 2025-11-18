<?php

use App\Infra\Database\Connection;
use App\Infra\Repositories\SQLiteParkingRepository;
use App\Infra\Pricing\SimplePriceCalculator;

$connection = Connection::get();
$repository = new SQLiteParkingRepository($connection);
