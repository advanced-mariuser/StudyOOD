<?php
declare(strict_types=1);

require_once __DIR__ . '/Beverage.php';
require_once __DIR__ . '/Types&Portions/MilkshakePortion.php';

class Milkshake extends Beverage
{
    private MilkshakePortion $portion;

    public function __construct(MilkshakePortion $portion)
    {
        parent::__construct("Milkshake");
        $this->portion = $portion;
    }

    public function getDescription(): string
    {
        return $this->portion->value . ' ' . parent::getDescription();
    }

    public function getCost(): float
    {
        return 80.0;
    }
}