<?php
declare(strict_types=1);

namespace modern_graphics_lib;

class RGBAColor
{
    public float $r, $g, $b, $a;

    public function __construct(float $r, float $g, float $b, float $a)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->a = $a;
    }
}