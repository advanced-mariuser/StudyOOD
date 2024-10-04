<?php
declare(strict_types=1);

require_once __DIR__ . '/FlyBehaviorInterface.php';

class FlyWithWings implements FlyBehaviorInterface
{
	public function fly(): void
	{
		echo "I'm flying with wings!!\n";
	}
}

