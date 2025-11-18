<?php
namespace App\Domain;

class Vehicle
{
    public function __construct(
        public string $plate,
        public string $type
    ) {}
}
