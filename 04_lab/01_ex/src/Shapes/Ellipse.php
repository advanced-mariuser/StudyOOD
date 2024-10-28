<?php
declare(strict_types=1);

require_once __DIR__ . '/Shape.php';
require_once __DIR__ . '/Point.php';

class Ellipse extends Shape
{
    private Point $center;
    private float $horizontalRadius;
    private float $verticalRadius;

    public function __construct(string $color, Point $center, float $horizontalRadius, float $verticalRadius)
    {
        parent::__construct($color);
        $this->center = $center;
        $this->horizontalRadius = $horizontalRadius;
        $this->verticalRadius = $verticalRadius;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->setColor($this->getColor());
        $canvas->drawEllipse($this->center->getX(), $this->center->getY(), $this->horizontalRadius, $this->verticalRadius);
    }
}