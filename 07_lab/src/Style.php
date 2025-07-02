<?php
declare(strict_types=1);

require_once __DIR__ . '/RGBAColor.php';

class Style
{
    private bool $enabled;
    private RGBAColor $color;
    private ?float $thickness = null;

    public function __construct()
    {
        $this->enabled = true;
        $this->color = new RGBAColor(255, 255, 255);
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnable(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getColor(): RGBAColor
    {
        return $this->color;
    }

    public function setColor(RGBAColor $color): void
    {
        $this->color = $color;
    }

    public function getThickness(): ?float
    {
        return $this->thickness;
    }

    public function setThickness(?float $thickness): void
    {
        $this->thickness = $thickness;
    }
}
