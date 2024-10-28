<?php
declare(strict_types=1);

require_once __DIR__ . '/../Beverages/BeverageInterface.php';

abstract class CondimentDecorator implements BeverageInterface {
    protected BeverageInterface $beverage;

    public function __construct(BeverageInterface $beverage) {
        $this->beverage = $beverage;
    }

    public function getDescription(): string {
        return $this->beverage->getDescription() . ', ' . $this->getCondimentDescription();
    }

    public function getCost(): float {
        return $this->beverage->getCost() + $this->getCondimentCost();
    }

    abstract protected function getCondimentDescription(): string;
    abstract protected function getCondimentCost(): float;
}