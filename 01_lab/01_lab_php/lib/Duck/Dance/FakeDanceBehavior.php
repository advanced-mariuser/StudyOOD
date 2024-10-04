<?php
declare(strict_types=1);

require_once __DIR__ . '/DanceBehaviorInterface.php';

class FakeDanceBehavior implements DanceBehaviorInterface
{
    public function dance(): void
    {
    }
}