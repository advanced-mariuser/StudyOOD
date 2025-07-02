<?php
declare(strict_types=1);

namespace graphics_lib;

interface CanvasInterface
{
    public function setColor(int $rgbColor): void;

    public function moveTo(int $x, int $y): void;

    public function lineTo(int $x, int $y): void;
}