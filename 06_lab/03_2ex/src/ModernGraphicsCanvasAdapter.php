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

class ModernGraphicsCanvasAdapter extends ModernGraphicsRenderer implements CanvasInterface
{
    private Point $currentPoint;
    private RGBAColor $currentColor;

    public function __construct($output)
    {
        parent::__construct($output);
        $this->currentPoint = new Point(0, 0);
        $this->currentColor = new RGBAColor(0, 0, 0 , 1);
        $this->beginDraw();
    }

    public function __destruct()
    {
        $this->endDraw();
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
        $this->drawLine($this->currentPoint, $nextPoint, $this->currentColor);
        $this->currentPoint = $nextPoint;
    }
}
