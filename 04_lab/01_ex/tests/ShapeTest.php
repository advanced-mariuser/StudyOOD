<?php
declare(strict_types=1);

use Canvas\CanvasInterface;
use PHPUnit\Framework\TestCase;
use Shape\Ellipse;
use Shape\Rectangle;

require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../src/Shapes/Shape.php';
require_once __DIR__. '/../src/Shapes/Rectangle.php';
require_once __DIR__. '/../src/Shapes/Ellipse.php';
require_once __DIR__. '/../src/Shapes/Triangle.php';
require_once __DIR__. '/../src/Shapes/RegularPolygon.php';
require_once __DIR__. '/../src/Shapes/Color.php';
require_once __DIR__. '/../src/Shapes/Point.php';
require_once __DIR__. '/../src/Canvas/CanvasInterface.php';

class ShapeTest extends TestCase
{
    public function testRectangleDraw()
    {
        $canvas = $this->createMock(CanvasInterface::class);

        $canvas->expects($this->exactly(4))
            ->method('drawLine')
            ->willReturnCallback(function (Point $from, Point $to) {
                static $call = 0;
                $expectedCoordinates = [
                    [new Point(0, 0), new Point(100, 0)],
                    [new Point(100, 0), new Point(100, 50)],
                    [new Point(100, 50), new Point(0, 50)],
                    [new Point(0, 50), new Point(0, 0)]
                ];
                $this->assertEquals($expectedCoordinates[$call][0], $from);
                $this->assertEquals($expectedCoordinates[$call][1], $to);
                $call++;
            });


        $rectangle = new Rectangle(Color::Green->value, new Point(0, 0), new Point(100, 50));
        $rectangle->draw($canvas);
    }

    public function testEllipseDraw()
    {
        $canvas = $this->createMock(CanvasInterface::class);

        $canvas->expects($this->once())
            ->method('drawEllipse')
            ->with(
                $this->equalTo(100),
                $this->equalTo(50),
                $this->equalTo(50),
                $this->equalTo(25)
            );

        $ellipse = new Ellipse(Color::Red->value, new Point(100, 50), 50, 25);
        $ellipse->draw($canvas);
    }

    public function testTriangleDraw()
    {
        $canvas = $this->createMock(CanvasInterface::class);

        $canvas->expects($this->exactly(3))
            ->method('drawLine')
            ->willReturnCallback(function (Point $from, Point $to) {
                static $call = 0;
                $expectedCoordinates = [
                    [new Point(0, 0), new Point(50, 100)],
                    [new Point(50, 100), new Point(100, 0)],
                    [new Point(100, 0), new Point(0, 0)]
                ];
                $this->assertEquals($expectedCoordinates[$call][0], $from);
                $this->assertEquals($expectedCoordinates[$call][1], $to);
                $call++;
            });

        $triangle = new Triangle(Color::Blue->value, new Point(0, 0), new Point(50, 100), new Point(100, 0));
        $triangle->draw($canvas);
    }

    public function testPolygonDraw()
    {
        $canvas = $this->createMock(CanvasInterface::class);

        $canvas->expects($this->exactly(5))->method('drawLine');

        $polygon = new RegularPolygon(Color::Yellow->value, new Point(50, 50), 5, 50);
        $polygon->draw($canvas);
    }
}
