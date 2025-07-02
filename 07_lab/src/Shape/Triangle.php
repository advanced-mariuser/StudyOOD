<?php
declare(strict_types=1);

require_once __DIR__ . '/Shape.php';
require_once __DIR__ . '/../Canvas/CanvasInterface.php';

class Triangle extends Shape
{
    public function draw(CanvasInterface $canvas): void
    {
        $canvas->setLineColor($this->getStrokeStyle()->getColor());
        $canvas->setLineThickness($this->getStrokeStyle()->getThickness());
        $canvas->setFillColor($this->getFillStyle()->getColor());

        $points = [
            ['x' => $this->getFrame()->left, 'y' => $this->getFrame()->top],
            ['x' => $this->getFrame()->left + $this->getFrame()->width, 'y' => $this->getFrame()->top + $this->getFrame()->height],
            ['x' => $this->getFrame()->left, 'y' => $this->getFrame()->top + $this->getFrame()->height]
        ];

        $canvas->fillPolygon($points);
        $canvas->drawLine($points[0]['x'], $points[0]['y'], $points[1]['x'], $points[1]['y']);
        $canvas->drawLine($points[1]['x'], $points[1]['y'], $points[2]['x'], $points[2]['y']);
        $canvas->drawLine($points[2]['x'], $points[2]['y'], $points[0]['x'], $points[0]['y']);
    }
}
