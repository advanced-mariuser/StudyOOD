<?php
declare(strict_types=1);

use Canvas\CanvasInterface;
use Shape\Shape;

require_once __DIR__ . '/Shape.php';
require_once __DIR__ . '/Point.php';

class RegularPolygon extends Shape
{
    private Point $center;
    private int $vertexCount;
    private float $radius;

    public function __construct(string $color, Point $center, int $vertexCount, float $radius)
    {
        parent::__construct($color);
        $this->center = $center;
        $this->vertexCount = $vertexCount;
        $this->radius = $radius;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->setColor($this->getColor());
        $angleStep = 2 * M_PI / $this->vertexCount;
        $points = [];

        for ($i = 0; $i < $this->vertexCount; $i++)
        {
            $x = $this->center->getX() + $this->radius * cos($i * $angleStep);
            $y = $this->center->getY() + $this->radius * sin($i * $angleStep);
            $points[] = new Point($x, $y);
        }

        for ($i = 0; $i < $this->vertexCount; $i++)
        {
            $next = ($i + 1) % $this->vertexCount;
            $canvas->drawLine($points[$i], $points[$next]);
        }
    }
}