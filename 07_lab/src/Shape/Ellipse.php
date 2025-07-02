<?php
declare(strict_types=1);

require_once __DIR__ . '/Shape.php';
require_once __DIR__ . '/../Canvas/CanvasInterface.php';

class Ellipse extends Shape
{
    public function draw(CanvasInterface $canvas): void
    {
        $canvas->setLineColor($this->getStrokeStyle()->getColor());
        $canvas->setLineThickness($this->getStrokeStyle()->getThickness());
        $canvas->setFillColor($this->getFillStyle()->getColor());

        $canvas->fillEllipse($this->getFrame()->left, $this->getFrame()->top, $this->getFrame()->width, $this->getFrame()->height);
        $canvas->drawEllipse($this->getFrame()->left, $this->getFrame()->top, $this->getFrame()->width, $this->getFrame()->height);
    }
}
