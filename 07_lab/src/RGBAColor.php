<?php
declare(strict_types=1);

class RGBAColor
{
    public int $red;
    public int $green;
    public int $blue;
    public float $alpha;

    public function __construct(int $red, int $green, int $blue, float $alpha = 1.0)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
        $this->alpha = $alpha;
    }
}