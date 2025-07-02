<?php
declare(strict_types=1);

namespace shape_drawing_lib;

require_once __DIR__ . '/../graphics_lib/CanvasInterface.php';

use graphics_lib\CanvasInterface;

interface CanvasDrawableInterface
{
    public function draw(CanvasInterface $canvas): void;
}