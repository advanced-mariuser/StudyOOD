<?php
declare(strict_types=1);

use Shape\Shape;

require_once __DIR__ . '/../Shapes/Shape.php';

interface ShapeFactoryInterface
{
    public function createShape(string $description): Shape;
}