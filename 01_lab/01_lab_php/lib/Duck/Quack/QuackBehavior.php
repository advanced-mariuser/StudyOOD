<?php
declare(strict_types=1);

require_once __DIR__ . '/QuackBehaviorInterface.php';

class QuackBehavior implements QuackBehaviorInterface
{
	public function quack(): void
	{
		echo "Quack Quack!!!\n";
	}
}
