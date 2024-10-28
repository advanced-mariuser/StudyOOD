<?php
declare(strict_types=1);

require_once __DIR__ . '/Shape.php';
require_once __DIR__ . '/Point.php';

class Rectangle extends Shape
{
    private Point  $leftTop;
    private Point  $rightBottom;

    public function __construct(string $color, Point $leftTop, Point $rightBottom)
    {
        parent::__construct($color);
        $this->leftTop = $leftTop;
        $this->rightBottom = $rightBottom;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->setColor($this->getColor());
        $canvas->drawLine($this->leftTop, new Point($this->rightBottom->getX(), $this->leftTop->getY()));
        $canvas->drawLine(new Point($this->rightBottom->getX(), $this->leftTop->getY()), $this->rightBottom);
        $canvas->drawLine($this->rightBottom, new Point($this->leftTop->getX(), $this->rightBottom->getY()));
        $canvas->drawLine(new Point($this->leftTop->getX(), $this->rightBottom->getY()), $this->leftTop);
    }
}