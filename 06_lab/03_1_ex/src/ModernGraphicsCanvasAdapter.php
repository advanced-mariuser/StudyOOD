<?php
declare(strict_types=1);

namespace app;

require_once __DIR__ . '/../lib/graphics_lib/CanvasInterface.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/ModernGraphicsRenderer.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/Point.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/RGBAColor.php';

use graphics_lib\CanvasInterface;
use modern_graphics_lib\ModernGraphicsRenderer;
use modern_graphics_lib\Point;
use modern_graphics_lib\RGBAColor;

class ModernGraphicsCanvasAdapter implements CanvasInterface
{
    private ModernGraphicsRenderer $renderer;
    private Point $currentPoint;
    private RGBAColor $currentColor;

    public function __construct(ModernGraphicsRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->currentPoint = new Point(0, 0);
        //проверять начальное состояние в том числе
        $this->currentColor = new RGBAColor(0, 1, 0, 1);
    }

    public function moveTo(int $x, int $y): void
    {
        $this->currentPoint = new Point($x, $y);
    }

    public function setColor(int $rgbColor): void
    {
        $r = ($rgbColor >> 16) & 0xFF;
        $g = ($rgbColor >> 8) & 0xFF;
        $b = $rgbColor & 0xFF;
        $this->currentColor = new RGBAColor((float)$r, (float)$g, (float)$b, 1.0);
    }

    public function lineTo(int $x, int $y): void
    {
        $nextPoint = new Point($x, $y);
        $this->renderer->drawLine($this->currentPoint, $nextPoint, $this->currentColor);
        $this->currentPoint = $nextPoint;
    }
}
