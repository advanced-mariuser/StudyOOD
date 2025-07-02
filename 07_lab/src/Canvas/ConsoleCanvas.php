<?php
declare(strict_types=1);

require_once __DIR__ . '/CanvasInterface.php';

class ConsoleCanvas implements CanvasInterface
{
    public function setLineColor(RGBAColor $color): void
    {
        echo "Setting line color to RGBA({$color->red}, {$color->green}, {$color->blue}, {$color->alpha})\n";
    }

    public function setLineThickness(float $thickness): void
    {
        echo "Setting line thickness to {$thickness}\n";
    }

    public function setFillColor(RGBAColor $color): void
    {
        echo "Setting fill color to RGBA({$color->red}, {$color->green}, {$color->blue}, {$color->alpha})\n";
    }

    public function drawLine(float $x1, float $y1, float $x2, float $y2): void
    {
        echo "Drawing line from ({$x1}, {$y1}) to ({$x2}, {$y2})\n";
    }

    public function drawEllipse(float $x, float $y, float $width, float $height): void
    {
        echo "Drawing ellipse at ({$x}, {$y}) with width {$width} and height {$height}\n";
    }

    public function fillEllipse(float $x, float $y, float $width, float $height): void
    {
        echo "Filling ellipse at ({$x}, {$y}) with width {$width} and height {$height}\n";
    }

    public function fillPolygon(array $points): void
    {
        echo "Filling polygon with points: " . implode(', ', array_map(fn($p) => "({$p['x']}, {$p['y']})", $points)) . "\n";
    }
}
