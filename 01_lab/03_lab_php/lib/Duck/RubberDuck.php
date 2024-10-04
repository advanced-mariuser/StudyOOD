<?php
declare(strict_types=1);

require_once __DIR__ . '/Duck.php';
require_once __DIR__ . '/Fly/FlyBehavior.php';
require_once __DIR__ . '/Quack/QuackBehavior.php';
require_once __DIR__ . '/Dance/DanceBehavior.php';

class RubberDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(flyNoWay(), squeak(), fakeDance());
    }

    public function display(): void
    {
        echo "I'm rubber duck\n";
    }
}
