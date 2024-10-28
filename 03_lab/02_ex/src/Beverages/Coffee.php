<?php
declare(strict_types=1);

require_once __DIR__ . '/Beverage.php';
require_once __DIR__ . '/Types&Portions/CoffeePortion.php';

class Coffee extends Beverage
{
    private CoffeePortion $portion;

    public function __construct(CoffeePortion $portion, string $description = "Coffee")
    {
        parent::__construct($description);
        $this->portion = $portion;
    }

    public function getDescription(): string
    {
        return $this->portion->value . ' ' . parent::getDescription();
    }

    public function getCost(): float
    {
        return 60.0;
    }

    protected function getPortion(): CoffeePortion
    {
        return $this->portion;
    }
}