<?php
declare(strict_types=1);

use Shape\Ellipse;
use Shape\Rectangle;
use Shape\Shape;

require_once __DIR__ . '/ShapeFactoryInterface.php';
require_once __DIR__ . '/../Shapes/Rectangle.php';
require_once __DIR__ . '/../Shapes/Triangle.php';
require_once __DIR__ . '/../Shapes/Ellipse.php';
require_once __DIR__ . '/../Shapes/RegularPolygon.php';

class ShapeFactory implements ShapeFactoryInterface
{
    public function createShape(string $description): Shape
    {
        $parts = explode(" ", $description);
        $shapeType = strtolower($parts[0]);

        //при ошибке создания фигуры программа не должна останваливаться
        return match ($shapeType)
        {
            'rectangle' => new Rectangle(
                $parts[1],
                new Point(floatval($parts[2]), floatval($parts[3])),
                new Point(floatval($parts[4]), floatval($parts[5]))
            ),
            'ellipse' => new Ellipse(
                $parts[1],
                new Point(floatval($parts[2]), floatval($parts[3])),
                floatval($parts[4]),
                floatval($parts[5])
            ),
            'triangle' => new Triangle(
                $parts[1],
                new Point(floatval($parts[2]), floatval($parts[3])),
                new Point(floatval($parts[4]), floatval($parts[5])),
                new Point(floatval($parts[6]), floatval($parts[7]))),
            'polygon' => new RegularPolygon(
                $parts[1],
                new Point(floatval($parts[2]), floatval($parts[3])),
                intval($parts[4]),
                floatval($parts[5])
            ),
            default => throw new InvalidArgumentException("Unknown shape type: $shapeType"),
        };
    }
}