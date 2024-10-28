<?php
declare(strict_types=1);

require_once __DIR__ . '/Shape.php';
require_once __DIR__ . '/Point.php';

class Triangle extends Shape
{
    private Point $vertex1;
    private Point $vertex2;
    private Point $vertex3;

    public function __construct(string $color, Point $vertex1, Point $vertex2, Point $vertex3)
    {
        parent::__construct($color);
        $this->vertex1 = $vertex1;
        $this->vertex2 = $vertex2;
        $this->vertex3 = $vertex3;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->setColor($this->getColor());
        $canvas->drawLine($this->vertex1, $this->vertex2);
        $canvas->drawLine($this->vertex2, $this->vertex3);
        $canvas->drawLine($this->vertex3, $this->vertex1);
    }
}