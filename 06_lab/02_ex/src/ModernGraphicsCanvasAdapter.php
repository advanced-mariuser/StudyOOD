<?php
declare(strict_types=1);

namespace app;

require_once __DIR__ . '/../lib/graphics_lib/CanvasInterface.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/ModernGraphicsRenderer.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/Point.php';

use graphics_lib\CanvasInterface;
use modern_graphics_lib\ModernGraphicsRenderer;
use modern_graphics_lib\Point;

class ModernGraphicsCanvasAdapter extends ModernGraphicsRenderer implements CanvasInterface
{
    private Point $currentPoint;

    public function __construct($output)
    {
        parent::__construct($output);
        $this->currentPoint = new Point(0, 0);
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

    public function lineTo(int $x, int $y): void
    {
        $nextPoint = new Point($x, $y);
        $this->drawLine($this->currentPoint, $nextPoint);
        $this->currentPoint = $nextPoint;
    }
}
