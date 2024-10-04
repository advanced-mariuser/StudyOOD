<?php
declare(strict_types=1);

require_once __DIR__ . '/Duck.php';
require_once __DIR__ . '/Fly/FlyWithWings.php';
require_once __DIR__ . '/Quack/QuackBehavior.php';

class MallardDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(new FlyWithWings(), new QuackBehavior());
    }

    public function display(): void
    {
        echo "I'm mallard duck\n";
    }
}
