<?php
declare(strict_types=1);

require_once __DIR__ . '/CanvasInterface.php';
require_once __DIR__ . '/../RGBAColor.php';

class SvgCanvas implements CanvasInterface
{
    private string $output;
    private array $elements = [];

    private $currentStrokeColor;
    private $currentStrokeWidth;
    private $currentFillColor;

    public function __construct(string $output = 'output.svg')
    {
        $this->output = $output;
    }

    public function setLineColor(RGBAColor $color): void
    {
        $this->currentStrokeColor = sprintf(
            'rgba(%d, %d, %d, %.2f)',
            $color->red,
            $color->green,
            $color->blue,
            $color->alpha / 255
        );
    }

    public function setLineThickness(?float $thickness): void
    {
        $this->currentStrokeWidth = $thickness;
    }

    public function setFillColor(RGBAColor $color): void
    {
        $this->currentFillColor = sprintf(
            'rgba(%d, %d, %d, %.2f)',
            $color->red,
            $color->green,
            $color->blue,
            $color->alpha / 255
        );
    }

    public function drawLine(float $x1, float $y1, float $x2, float $y2): void
    {
        $this->elements[] = sprintf(
            '<line x1="%f" y1="%f" x2="%f" y2="%f" stroke="%s" stroke-width="%f" />',
            $x1,
            $y1,
            $x2,
            $y2,
            $this->currentStrokeColor,
            $this->currentStrokeWidth
        );
    }

    public function drawEllipse(float $x, float $y, float $width, float $height): void
    {
        $this->elements[] = sprintf(
            '<ellipse cx="%f" cy="%f" rx="%f" ry="%f" fill="none" stroke="%s" stroke-width="%f" />',
            $x + $width / 2,
            $y + $height / 2,
            $width / 2,
            $height / 2,
            $this->currentStrokeColor,
            $this->currentStrokeWidth
        );
    }

    public function fillEllipse(float $x, float $y, float $width, float $height): void
    {
        $this->elements[] = sprintf(
            '<ellipse cx="%f" cy="%f" rx="%f" ry="%f" fill="%s" stroke="none" />',
            $x + $width / 2,
            $y + $height / 2,
            $width / 2,
            $height / 2,
            $this->currentFillColor
        );
    }

    public function fillPolygon(array $points): void
    {
        $pointsString = implode(' ', array_map(fn($p) => "{$p['x']},{$p['y']}", $points));
        $this->elements[] = sprintf(
            '<polygon points="%s" fill="%s" stroke="none" />',
            $pointsString,
            $this->currentFillColor
        );
    }

    public function save(): void
    {
        $svgContent = sprintf(
            '<svg xmlns="http://www.w3.org/2000/svg" width="4000" height="4000">%s</svg>',
            implode("\n", $this->elements)
        );

        file_put_contents($this->output, $svgContent);
    }
}
