<?php
declare(strict_types=1);

require_once __DIR__ . '/../Shapes/Color.php';
require_once __DIR__ . '/../Shapes/Point.php';

interface CanvasInterface
{
    public function setColor(Color $color): void;
    public function drawLine(Point $from, Point $to): void;
    public function drawEllipse(float $l, float $t, float $w, float $h): void;
}