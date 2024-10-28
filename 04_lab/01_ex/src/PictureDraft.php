<?php
declare(strict_types=1);

class PictureDraft
{
    private array $shapes = [];

    public function addShape(Shape $shape): void
    {
        $this->shapes[] = $shape;
    }

    public function getShapes(): array
    {
        return $this->shapes;
    }

    public function getShapeCount(): int
    {
        return count($this->shapes);
    }
}