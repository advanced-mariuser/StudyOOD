<?php
declare(strict_types=1);

require_once __DIR__ . '/CanvasInterface.php';

class SVGCanvas implements CanvasInterface
{
    private string $svgContent;
    private Color $color;

    public function __construct()
    {
        $this->svgContent = '<svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1080">';
    }

    public function setColor(Color $color): void
    {
        $this->color = $color;
    }

    public function drawLine(Point $from, Point $to): void
    {
        $this->svgContent .= "<line x1=\"{$from->getX()}\" y1=\"{$from->getY()}\" x2=\"{$to->getX()}\" y2=\"{$to->getY()}\" stroke=\"{$this->color->value}\" />";
    }

    public function drawEllipse(float $l, float $t, float $w, float $h): void
    {
        $this->svgContent .= "<ellipse cx=\"$l\" cy=\"$t\" rx=\"$w\" ry=\"$h\" fill=\"none\" stroke=\"{$this->color->value}\" />";
    }

    public function saveToFile(string $filename): void
    {
        $this->svgContent .= '</svg>';
        file_put_contents($filename, $this->svgContent);
    }
}