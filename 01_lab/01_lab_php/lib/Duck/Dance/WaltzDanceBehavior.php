<?php
declare(strict_types=1);

require_once __DIR__ . '/DanceBehaviorInterface.php';

class WaltzDanceBehavior implements DanceBehaviorInterface
{
    public function dance(): void
    {
        echo "I can dance waltz!\n";
    }
}