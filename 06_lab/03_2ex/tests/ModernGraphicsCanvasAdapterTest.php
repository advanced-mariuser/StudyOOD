<?php
declare(strict_types=1);

use app\ModernGraphicsCanvasAdapter;
use modern_graphics_lib\Point;
use modern_graphics_lib\RGBAColor;
use shape_drawing_lib\Rectangle;
use shape_drawing_lib\Triangle;
use shape_drawing_lib\Point as DrawingPoint;
use graphics_lib\CanvasInterface;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/ModernGraphicsCanvasAdapter.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/ModernGraphicsRenderer.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/Point.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/RGBAColor.php';
require_once __DIR__ . '/../lib/shape_drawing_lib/Rectangle.php';
require_once __DIR__ . '/../lib/shape_drawing_lib/Triangle.php';
require_once __DIR__ . '/../lib/shape_drawing_lib/Point.php';
require_once __DIR__ . '/../lib/graphics_lib/CanvasInterface.php';

class ModernGraphicsCanvasAdapterTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws ReflectionException
     */
    public function testMoveToSetsStartingPoint()
    {
        $adapter = new ModernGraphicsCanvasAdapter(STDOUT);
        $adapter->moveTo(10, 20);

        $reflection = new ReflectionClass($adapter);
        $currentPoint = $reflection->getProperty('currentPoint');
        $this->assertEquals(new Point(10, 20), $currentPoint->getValue($adapter));
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws ReflectionException
     */
    public function testStartingPoint()
    {
        $adapter = new ModernGraphicsCanvasAdapter(STDOUT);

        $reflection = new ReflectionClass($adapter);
        $currentPoint = $reflection->getProperty('currentPoint');
        $this->assertEquals(new Point(0, 0), $currentPoint->getValue($adapter));
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testLineToDrawsLineFromCurrentPoint()
    {
        $mockRenderer = $this->getMockBuilder(ModernGraphicsCanvasAdapter::class)
            ->setConstructorArgs([STDOUT])
            ->onlyMethods(['endDraw', 'drawLine'])
            ->getMock();

        $mockRenderer->expects($this->once())
            ->method('drawLine')
            ->with(
                $this->equalTo(new Point(10, 20)),
                $this->equalTo(new Point(50, 30))
            );

        $adapter = $mockRenderer;
        $adapter->moveTo(10, 20);
        $adapter->lineTo(50, 30);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws ReflectionException
     */
    public function testAdapterEndsDrawingOnDestruction()
    {
        $mockRenderer = $this->getMockBuilder(ModernGraphicsCanvasAdapter::class)
            ->setConstructorArgs([STDOUT])
            ->onlyMethods(['endDraw'])
            ->getMock();

        $mockRenderer->expects($this->once())
            ->method('endDraw');

        $adapter = $mockRenderer;
        $reflection = new ReflectionClass($adapter);
        $destruct = $reflection->getMethod('__destruct');
        $destruct->invoke($adapter);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws ReflectionException
     */
    public function testCurrentPointUpdatesAfterLineTo(): void
    {
        $adapter = new ModernGraphicsCanvasAdapter(STDOUT);

        $adapter->moveTo(10, 20);
        $adapter->lineTo(30, 40);

        $reflection = new ReflectionClass($adapter);
        $currentPoint = $reflection->getProperty('currentPoint');

        $this->assertEquals(new Point(30, 40), $currentPoint->getValue($adapter));
    }

    /**
     * @throws \ReflectionException
     */
    public function testSetColor(): void
    {
        $adapter = new ModernGraphicsCanvasAdapter(STDOUT);

        $adapter->setColor(0xFF00FF);

        $reflection = new ReflectionClass($adapter);
        $currentColor = $reflection->getProperty('currentColor');

        $expectedColor = new RGBAColor(255.0, 0.0, 255.0, 1.0);
        $this->assertEquals($expectedColor, $currentColor->getValue($adapter));
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws ReflectionException
     */
    public function testStartingColor()
    {
        $adapter = new ModernGraphicsCanvasAdapter(STDOUT);

        $reflection = new ReflectionClass($adapter);
        $currentColor = $reflection->getProperty('currentColor');
        $this->assertEquals(new RGBAColor(0, 0, 0, 1), $currentColor->getValue($adapter));
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testLineToWithColor(): void
    {
        $mockRenderer = $this->getMockBuilder(ModernGraphicsCanvasAdapter::class)
            ->setConstructorArgs([STDOUT])
            ->onlyMethods(['drawLine'])
            ->getMock();

        $mockRenderer->setColor(0x00FF00);

        $mockRenderer->expects($this->once())
            ->method('drawLine')
            ->with(
                $this->equalTo(new Point(10, 20)),
                $this->equalTo(new Point(50, 30)),
                $this->equalTo(new RGBAColor(0.0, 255.0, 0.0, 1.0))
            );

        $mockRenderer->moveTo(10, 20);
        $mockRenderer->lineTo(50, 30);
    }

    /**
     * @throws \ReflectionException
     */
    public function testSetTransparentColor(): void
    {
        $adapter = new ModernGraphicsCanvasAdapter(STDOUT);

        $adapter->setColor(0x123456);

        $reflection = new ReflectionClass($adapter);
        $currentColor = $reflection->getProperty('currentColor');

        $expectedColor = new RGBAColor(18.0, 52.0, 86.0, 1.0);
        $this->assertEquals($expectedColor, $currentColor->getValue($adapter));
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testDrawColoredRectangle(): void
    {
        $mockCanvas = $this->createMock(CanvasInterface::class);

        $mockCanvas->expects($this->once())->method('setColor')->with(0xFF0000);

        $mockCanvas->expects($this->exactly(4))->method('lineTo');

        $rectangle = new Rectangle(new DrawingPoint(10, 10), 50, 40, 0xFF0000);
        $rectangle->draw($mockCanvas);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testDrawColoredTriangle(): void
    {
        $mockCanvas = $this->createMock(CanvasInterface::class);

        $mockCanvas->expects($this->once())->method('setColor')->with(0x0000FF);

        $mockCanvas->expects($this->exactly(3))->method('lineTo');

        $triangle = new Triangle(new DrawingPoint(0, 0), new DrawingPoint(100, 0), new DrawingPoint(50, 100), 0x0000FF);
        $triangle->draw($mockCanvas);
    }
}