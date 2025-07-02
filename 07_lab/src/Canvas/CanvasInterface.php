<?php
declare(strict_types=1);

require_once __DIR__ . '/../RGBAColor.php';

interface CanvasInterface
{
    public function setLineColor(RGBAColor $color): void;
    public function setLineThickness(float $thickness): void;
    public function setFillColor(RGBAColor $color): void;
    public function drawLine(float $x1, float $y1, float $x2, float $y2): void;
    public function drawEllipse(float $x, float $y, float $width, float $height): void;
    public function fillEllipse(float $x, float $y, float $width, float $height): void;
    public function fillPolygon(array $points): void;
}
