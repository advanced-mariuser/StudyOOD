<?php
declare(strict_types=1);

require_once __DIR__ . '/CondimentDecorator.php';
require_once __DIR__ . '/Types/LiqueurType.php';

class Liqueur extends CondimentDecorator {
    private LiqueurType $liqueurType;

    public function __construct(BeverageInterface $beverage, LiqueurType $liqueurType) {
        parent::__construct($beverage);
        $this->liqueurType = $liqueurType;
    }

    protected function getCondimentCost(): float {
        return 50.0;
    }

    protected function getCondimentDescription(): string {
        return match ($this->liqueurType) {
            LiqueurType::Chocolate => "Chocolate liqueur",
            LiqueurType::Nutty => "Nutty liqueur",
        };
    }
}