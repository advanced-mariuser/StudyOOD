<?php
declare(strict_types=1);

require_once __DIR__ . '/CondimentDecorator.php';

class ChocolateSlice extends CondimentDecorator {
    private int $quantity;

    public function __construct(BeverageInterface $beverage, int $quantity)
    {
        parent::__construct($beverage);
        if ($quantity >= 0 && $quantity <= 5)
        {
            $this->quantity = $quantity;
        }
        else
        {
            throw new InvalidArgumentException("Invalid quantity");
        }
    }

    protected function getCondimentCost(): float {
        return 10.0 * $this->quantity;
    }

    protected function getCondimentDescription(): string {
        return "Chocolate slice";
    }
}