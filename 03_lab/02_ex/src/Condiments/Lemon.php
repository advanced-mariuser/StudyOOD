<?php
declare(strict_types=1);

require_once __DIR__ . '/CondimentDecorator.php';

class Lemon extends CondimentDecorator {
    private int $quantity;

    public function __construct(BeverageInterface $beverage, int $quantity = 1) {
        parent::__construct($beverage);
        $this->quantity = $quantity;
    }

    protected function getCondimentCost(): float {
        return 10.0 * $this->quantity;
    }

    protected function getCondimentDescription(): string {
        return "Lemon x " . $this->quantity;
    }
}