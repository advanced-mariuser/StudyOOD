<?php
declare(strict_types=1);

namespace app;

require_once __DIR__ . '/../lib/graphics_lib/Canvas.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/ModernGraphicsRenderer.php';
require_once __DIR__ . '/../lib/shape_drawing_lib/CanvasPainter.php';
require_once __DIR__ . '/../lib/shape_drawing_lib/Triangle.php';
require_once __DIR__ . '/../lib/shape_drawing_lib/Rectangle.php';
require_once __DIR__ . '/../lib/shape_drawing_lib/Point.php';

use graphics_lib\Canvas;
use modern_graphics_lib\ModernGraphicsRenderer;
use shape_drawing_lib\CanvasPainter;
use shape_drawing_lib\Triangle;
use shape_drawing_lib\Rectangle;
use shape_drawing_lib\Point;

function paintPicture(CanvasPainter $painter): void
{
    $triangle = new Triangle(new Point(10, 15), new Point(100, 200), new Point(150, 250));
    $rectangle = new Rectangle(new Point(30, 40), 18, 24);

    $painter->draw($triangle);
    $painter->draw($rectangle);
}

function paintPictureOnCanvas(): void
{
    $simpleCanvas = new Canvas();
    $painter = new CanvasPainter($simpleCanvas);

    paintPicture($painter);
}

function paintPictureOnModernGraphicsRenderer(): void
{
    $adapter = new ModernGraphicsCanvasAdapter(STDOUT);
    $painter = new CanvasPainter($adapter);
    paintPicture($painter);
}
