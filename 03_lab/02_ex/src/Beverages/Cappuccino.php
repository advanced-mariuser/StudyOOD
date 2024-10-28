<?php
declare(strict_types=1);

require_once __DIR__ . '/Coffee.php';

class Cappuccino extends Coffee
{
    public function getCost(): float
    {
        return match ($this->getPortion())
        {
            CoffeePortion::Standard => 80.0,
            CoffeePortion::Double => 120.0
        };
    }
}