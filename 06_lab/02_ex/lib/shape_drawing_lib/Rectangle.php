<?php
declare(strict_types=1);

namespace shape_drawing_lib;

require_once __DIR__ . '/../graphics_lib/CanvasInterface.php';
require_once __DIR__ . '/CanvasDrawableInterface.php';

use graphics_lib\CanvasInterface;

class Rectangle implements CanvasDrawableInterface
{
    private Point $leftTop;
    private int $width;
    private int $height;

    public function __construct(Point $leftTop, int $width, int $height)
    {
        $this->leftTop = $leftTop;
        $this->width = $width;
        $this->height = $height;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->moveTo($this->leftTop->x, $this->leftTop->y);
        $canvas->lineTo($this->leftTop->x + $this->width, $this->leftTop->y);
        $canvas->lineTo($this->leftTop->x + $this->width, $this->leftTop->y + $this->height);
        $canvas->lineTo($this->leftTop->x, $this->leftTop->y + $this->height);
        $canvas->lineTo($this->leftTop->x, $this->leftTop->y);
    }
}