<?php
declare(strict_types=1);

namespace shape_drawing_lib;

require_once __DIR__ . '/../graphics_lib/CanvasInterface.php';

use graphics_lib\CanvasInterface;

class CanvasPainter
{
    private CanvasInterface $canvas;

    public function __construct(CanvasInterface $canvas)
    {
        $this->canvas = $canvas;
    }

    public function draw(CanvasDrawableInterface $drawable): void
    {
        $drawable->draw($this->canvas);
    }
}