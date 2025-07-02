<?php
declare(strict_types=1);

namespace app;

require_once __DIR__ . '/../lib/graphics_lib/CanvasInterface.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/ModernGraphicsRenderer.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/Point.php';

use graphics_lib\CanvasInterface;
use modern_graphics_lib\ModernGraphicsRenderer;
use modern_graphics_lib\Point;

class ModernGraphicsCanvasAdapter implements CanvasInterface
{
    private ModernGraphicsRenderer $renderer;
    private Point $currentPoint;

    public function __construct(ModernGraphicsRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->currentPoint = new Point(0, 0);
    }

    public function moveTo(int $x, int $y): void
    {
        $this->currentPoint = new Point($x, $y);
    }

    public function lineTo(int $x, int $y): void
    {
        $nextPoint = new Point($x, $y);
        $this->renderer->drawLine($this->currentPoint, $nextPoint);
        //написать тест на этот случай
        $this->currentPoint = $nextPoint;
    }
}
