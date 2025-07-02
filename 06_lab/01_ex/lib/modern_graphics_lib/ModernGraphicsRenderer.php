<?php
declare(strict_types=1);

namespace modern_graphics_lib;

use LogicException;

class ModernGraphicsRenderer
{
    private $output;
    private bool $drawing = false;

    public function __construct($output)
    {
        $this->output = $output;
    }

    public function __destruct()
    {
        if ($this->drawing) {
            $this->endDraw();
        }
    }

    public function beginDraw(): void
    {
        if ($this->drawing) {
            throw new LogicException("Drawing has already begun");
        }
        fwrite($this->output, "<draw>\n");
        $this->drawing = true;
    }

    public function drawLine(Point $start, Point $end): void
    {
        if (!$this->drawing) {
            throw new LogicException("DrawLine is allowed between BeginDraw()/endDraw() only");
        }
        fwrite(
            $this->output,
            sprintf("  <line fromX=\"%d\" fromY=\"%d\" toX=\"%d\" toY=\"%d\"/>\n", $start->x, $start->y, $end->x, $end->y)
        );
    }

    public function endDraw(): void
    {
        if (!$this->drawing) {
            throw new LogicException("Drawing has not been started");
        }
        fwrite($this->output, "</draw>\n");
        $this->drawing = false;
    }
}
