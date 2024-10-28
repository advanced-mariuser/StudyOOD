<?php
declare(strict_types=1);

require_once __DIR__ . '/Canvas/SVGCanvas.php';
require_once __DIR__ . '/ShapeFactory/ShapeFactory.php';
require_once __DIR__ . '/Designer/DesignerInterface.php';
require_once __DIR__ . '/PictureDraft.php';
require_once __DIR__ . '/Painter.php';

class Client
{
    private DesignerInterface $designer;
    private Painter $painter;
    private SVGCanvas $canvas;

    public function __construct(DesignerInterface $designer, Painter $painter, SVGCanvas $canvas)
    {
        $this->designer = $designer;
        $this->painter = $painter;
        $this->canvas = $canvas;
    }

    public function run($inputStream = STDIN): void
    {
        echo "Enter shapes description (end with empty line):\n";

        $input = '';
        while (($line = fgets($inputStream)) !== false)
        {
            if (empty(trim($line)) || $line = "\r\n") break;
            $input .= $line;
        }

        try
        {
            $draft = $this->designer->createDraft($input);
            $this->painter->drawPicture($draft, $this->canvas);
            $this->canvas->saveToFile('output.svg');
            echo "SVG file 'output.svg' has been created.\n";
        } catch (InvalidArgumentException $e)
        {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}
