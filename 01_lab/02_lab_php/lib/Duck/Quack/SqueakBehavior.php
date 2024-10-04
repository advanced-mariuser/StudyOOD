<?php
declare(strict_types=1);

require_once __DIR__ . '/QuackBehaviorInterface.php';

class SqueakBehavior implements QuackBehaviorInterface
{
	public function quack():void
	{
		echo "Squeek!!!\n";
	}
}