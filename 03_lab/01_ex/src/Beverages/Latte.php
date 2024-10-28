<?php
declare(strict_types=1);

require_once __DIR__ . '/Coffee.php';

class Latte extends Coffee
{
    public function getCost(): float
    {
        return match ($this->getPortion())
        {
            CoffeePortion::Standard => 90.0,
            CoffeePortion::Double => 130.0
        };
    }
}