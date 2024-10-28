<?php
declare(strict_types=1);

require_once __DIR__ . '/CondimentDecorator.php';
require_once __DIR__ . '/Types/IceCubeType.php';

class IceCubes extends CondimentDecorator {
    private int $quantity;
    private IceCubeType $type;

    public function __construct(BeverageInterface $beverage, int $quantity, IceCubeType $type = IceCubeType::Water) {
        parent::__construct($beverage);
        $this->quantity = $quantity;
        $this->type = $type;
    }

    protected function getCondimentCost(): float {
        return ($this->type === IceCubeType::Dry ? 10 : 5) * $this->quantity;
    }

    protected function getCondimentDescription(): string {
        return match ($this->type) {
            IceCubeType::Dry => "Dry ice cubes x " . $this->quantity,
            IceCubeType::Water => "Water ice cubes x " . $this->quantity,
        };
    }
}