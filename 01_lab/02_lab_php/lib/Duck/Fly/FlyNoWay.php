<?php
declare(strict_types=1);

require_once __DIR__ . '/FlyBehaviorInterface.php';

class FlyNoWay implements FlyBehaviorInterface
{
	public function fly():void
    {
    }
}