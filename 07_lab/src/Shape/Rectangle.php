<?php
declare(strict_types=1);

require_once __DIR__ . '/Shape.php';

class Rectangle extends Shape
{
    public function draw(CanvasInterface $canvas): void
    {
        $canvas->setLineColor($this->getStrokeStyle()->getColor());
        $canvas->setLineThickness($this->getStrokeStyle()->getThickness());
        $canvas->setFillColor($this->getFillStyle()->getColor());

        $points = [
            ['x' => $this->getFrame()->left, 'y' => $this->getFrame()->top],
            ['x' => $this->getFrame()->left + $this->getFrame()->width, 'y' => $this->getFrame()->top],
            ['x' => $this->getFrame()->left + $this->getFrame()->width, 'y' => $this->getFrame()->top + $this->getFrame()->height],
            ['x' => $this->getFrame()->left, 'y' => $this->getFrame()->top + $this->getFrame()->height]
        ];

        $canvas->drawLine($this->getFrame()->left, $this->getFrame()->top, $this->getFrame()->left + $this->getFrame()->width, $this->getFrame()->top);
        $canvas->drawLine($this->getFrame()->left + $this->getFrame()->width, $this->getFrame()->top, $this->getFrame()->left + $this->getFrame()->width, $this->getFrame()->top + $this->getFrame()->height);
        $canvas->drawLine($this->getFrame()->left + $this->getFrame()->width, $this->getFrame()->top + $this->getFrame()->height, $this->getFrame()->left, $this->getFrame()->top + $this->getFrame()->height);
        $canvas->drawLine($this->getFrame()->left, $this->getFrame()->top + $this->getFrame()->height, $this->getFrame()->left, $this->getFrame()->top);
        $canvas->fillPolygon($points);
    }
}
