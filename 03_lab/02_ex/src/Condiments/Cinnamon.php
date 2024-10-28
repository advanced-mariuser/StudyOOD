<?php
declare(strict_types=1);

require_once __DIR__ . '/CondimentDecorator.php';

class Cinnamon extends CondimentDecorator {
    protected function getCondimentCost(): float {
        return 20.0;
    }

    protected function getCondimentDescription(): string {
        return "Cinnamon";
    }
}