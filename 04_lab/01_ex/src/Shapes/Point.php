<?php
declare(strict_types=1);

class Point
{
    public function __construct(
        private readonly float $x,
        private readonly float $y
    ) {}

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }
}
