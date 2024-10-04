<?php
declare(strict_types=1);

require_once __DIR__ . '/Duck.php';
require_once __DIR__ . '/Fly/FlyBehavior.php';
require_once __DIR__ . '/Quack/QuackBehavior.php';
require_once __DIR__ . '/Dance/DanceBehavior.php';

class ModelDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(flyWithWings(), quack(), fakeDance());
    }

    public function display(): void
    {
        echo "I'm model duck\n";
    }
}
