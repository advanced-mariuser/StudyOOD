<?php
declare(strict_types=1);

require_once __DIR__ . '/Duck.php';
require_once __DIR__ . '/Fly/FlyNoWay.php';
require_once __DIR__ . '/Quack/MuteQuackBehavior.php';
require_once __DIR__ . '/Dance/FakeDanceBehavior.php';

class DecoyDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(new FlyNoWay(), new MuteQuackBehavior(), new FakeDanceBehavior());
    }

    public function display(): void
    {
        echo "I'm decoy duck\n";
    }
}
