<?php
declare(strict_types=1);

require_once __DIR__ . '/Beverage.php';
require_once __DIR__ . '/Types&Portions/TeaType.php';

class Tea extends Beverage
{
    private TeaType $teaType;

    public function __construct(TeaType $teaType)
    {
        parent::__construct("Tea");
        $this->teaType = $teaType;
    }

    public function getDescription(): string
    {
        return $this->teaType->value . " " . parent::getDescription();
    }

    public function getCost(): float
    {
        return 30.0;
    }
}