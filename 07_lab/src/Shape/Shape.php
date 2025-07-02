<?php
declare(strict_types=1);

require_once __DIR__ . '/../Style.php';
require_once __DIR__ . '/../Rect.php';

abstract class Shape
{
    private ?Rect $frame;
    private Style $strokeStyle;
    private Style $fillStyle;

    public function __construct(?Rect $frame = null)
    {
        $this->frame = $frame;
        $this->strokeStyle = new Style();
        $this->fillStyle = new Style();
    }

    public function getFrame(): ?Rect
    {
        return $this->frame;
    }

    public function setFrame(Rect $newFrame): void
    {
        $this->frame = $newFrame;
    }

    public function getComposite(): ?GroupShape
    {
        return null;
    }

    public function getStrokeStyle(): Style
    {
        return $this->strokeStyle;
    }

    public function getFillStyle(): Style
    {
        return $this->fillStyle;
    }

    public function setStrokeStyle(Style $newStyle): void
    {
        $this->strokeStyle = $newStyle;
    }

    public function setFillStyle(Style $newStyle): void
    {
        $this->fillStyle = $newStyle;
    }

    abstract public function draw(CanvasInterface $canvas): void;
}
