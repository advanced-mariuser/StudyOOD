<?php
declare(strict_types=1);

require_once __DIR__ . '/CondimentDecorator.php';
require_once __DIR__ . '/Types/SyrupType.php';

class Syrup extends CondimentDecorator {
    private SyrupType $syrupType;

    public function __construct(BeverageInterface $beverage, SyrupType $syrupType) {
        parent::__construct($beverage);
        $this->syrupType = $syrupType;
    }

    protected function getCondimentCost(): float {
        return 15.0;
    }

    protected function getCondimentDescription(): string {
        return match ($this->syrupType) {
            SyrupType::Chocolate => "Chocolate syrup",
            SyrupType::Maple => "Maple syrup",
        };
    }
}