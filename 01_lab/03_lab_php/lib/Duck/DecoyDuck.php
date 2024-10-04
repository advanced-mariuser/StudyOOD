<?php
declare(strict_types=1);

require_once __DIR__ . '/Duck.php';

class DecoyDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(flyNoWay(), muteQuack(), fakeDance());
    }

    public function display(): void
    {
        echo "I'm decoy duck\n";
    }
}