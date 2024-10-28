<?php
declare(strict_types=1);

require_once __DIR__ . '/../Canvas/CanvasInterface.php';
require_once __DIR__ . '/Color.php';

abstract class Shape
{
    protected Color $color;

    public function __construct(string $color)
    {
        $this->color = Color::from($color);
    }

    abstract public function draw(CanvasInterface $canvas): void;

    public function getColor(): Color
    {
        return $this->color;
    }
}