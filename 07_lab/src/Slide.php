<?php
declare(strict_types=1);

require_once __DIR__ . '/Canvas/CanvasInterface.php';
require_once __DIR__ . '/Canvas/SVGCanvas.php';
require_once __DIR__ . '/Shape/Shape.php';

class Slide
{
    /** @var Shape[] */
    private array $shapes;

    public function __construct()
    {
        $this->shapes = [];
    }

    public function addShape(Shape $shape): void
    {
        $this->shapes[] = $shape;
    }

    public function draw(CanvasInterface $canvas): void
    {
        foreach ($this->shapes as $shape) {
            $shape->draw($canvas);
        }

        if ($canvas instanceof SvgCanvas) {
            $canvas->save();
        }
    }
}
