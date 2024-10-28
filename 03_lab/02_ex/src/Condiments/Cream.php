<?php
declare(strict_types=1);

require_once __DIR__ . '/CondimentDecorator.php';

class Cream extends CondimentDecorator {

    protected function getCondimentCost(): float {
        return 25.0;
    }

    protected function getCondimentDescription(): string {
        return "Cream";
    }
}