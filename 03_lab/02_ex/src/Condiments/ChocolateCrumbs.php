<?php
declare(strict_types=1);

require_once __DIR__ . '/CondimentDecorator.php';

class ChocolateCrumbs extends CondimentDecorator {
    private int $mass;

    public function __construct(BeverageInterface $beverage, int $mass) {
        parent::__construct($beverage);
        $this->mass = $mass;
    }

    protected function getCondimentCost(): float {
        return 2.0 * $this->mass;
    }

    protected function getCondimentDescription(): string {
        return "Chocolate crumbs " . $this->mass . "g";
    }
}