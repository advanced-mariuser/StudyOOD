<?php
declare(strict_types=1);

use Canvas\SVGCanvas;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Painter.php';
require_once __DIR__ . '/../src/Designer/DesignerInterface.php';
require_once __DIR__ . '/../src/Canvas/CanvasInterface.php';
require_once __DIR__ . '/../src/PictureDraft.php';
require_once __DIR__ . '/../src/Client.php';

class ClientTest extends TestCase
{
    public function testRun()
    {
        $input = "rectangle green 0 0 100 50\nellipse red 100 50 50 25\n";
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $input);
        rewind($stream);

        $factory = new ShapeFactory();
        $designer = new Designer($factory);
        $painter = new Painter();
        $canvas = new SVGCanvas();

        $client = new Client($designer, $painter, $canvas);
        ob_start();
        $client->run($stream);
        $output = ob_get_clean();

        $this->assertStringContainsString("SVG file 'output.svg' has been created.", $output);

        fclose($stream);
    }
}
