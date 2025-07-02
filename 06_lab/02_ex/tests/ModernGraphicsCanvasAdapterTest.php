<?php
declare(strict_types=1);

use app\ModernGraphicsCanvasAdapter;
use modern_graphics_lib\Point;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/ModernGraphicsCanvasAdapter.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/ModernGraphicsRenderer.php';
require_once __DIR__ . '/../lib/modern_graphics_lib/Point.php';

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
}