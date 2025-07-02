<?php
declare(strict_types=1);

namespace graphics_lib;

class Canvas implements CanvasInterface
{
    private int $currentX = 0;
    private int $currentY = 0;
    private string $color;

    public function setColor(int $rgbColor): void
    {
        $this->color = sprintf('#%06X', $rgbColor);
        echo "SetColor {$this->color}\n";
    }

    public function moveTo(int $x, int $y): void
    {
        $this->currentX = $x;
        $this->currentY = $y;
        echo "MoveTo ($this->currentX, $this->currentY)\n";
    }

    public function lineTo(int $x, int $y): void
    {
        echo "LineTo ($x, $y)\n";
        $this->moveTo($x, $y);
    }
}