<?php
declare(strict_types=1);

require_once __DIR__ . '/CanvasInterface.php';

class Canvas implements CanvasInterface
{
    public function setColor(string $color): void
    {
        echo "Set color to $color\n";
    }

    public function drawLine(array $from, array $to): void
    {
        echo "Draw line from (" . implode(",", $from) . ") to (" . implode(",", $to) . ")\n";
    }

    public function drawEllipse(float $l, float $t, float $w, float $h): void
    {
        echo "Draw ellipse at ($l,$t) with width $w and height $h\n";
    }
}