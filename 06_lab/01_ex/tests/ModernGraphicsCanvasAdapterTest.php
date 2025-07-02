<?php
declare(strict_types=1);

use app\ModernGraphicsCanvasAdapter;
use modern_graphics_lib\ModernGraphicsRenderer;
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
     */
    public function testMoveToSetsStartingPoint()
    {
        $mockRenderer = $this->createMock(ModernGraphicsRenderer::class);
        $adapter = new ModernGraphicsCanvasAdapter($mockRenderer);

        $mockRenderer->beginDraw();
        $adapter->moveTo(10, 20);
        $mockRenderer->endDraw();

        $reflection = new ReflectionClass($adapter);
        $currentPoint = $reflection->getProperty('currentPoint');
        $this->assertEquals(new Point(10, 20), $currentPoint->getValue($adapter));
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testStartingPoint()
    {
        $mockRenderer = $this->createMock(ModernGraphicsRenderer::class);
        $adapter = new ModernGraphicsCanvasAdapter($mockRenderer);

        $reflection = new ReflectionClass($adapter);
        $currentPoint = $reflection->getProperty('currentPoint');
        $this->assertEquals(new Point(0, 0), $currentPoint->getValue($adapter));
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testLineToDrawsLineFromCurrentPoint()
    {
        $mockRenderer = $this->createMock(ModernGraphicsRenderer::class);
        $mockRenderer->expects($this->once())->method('drawLine')
            ->with($this->equalTo(new Point(10, 20)), $this->equalTo(new Point(50, 30)));

        $mockRenderer->beginDraw();
        $adapter = new ModernGraphicsCanvasAdapter($mockRenderer);
        $adapter->moveTo(10, 20);
        $adapter->lineTo(50, 30);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testLineToWithoutMoveToDoesNotDrawLine()
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage("DrawLine is allowed between BeginDraw()/endDraw() only");

        $renderer = new ModernGraphicsRenderer(STDOUT);

        $adapter = new ModernGraphicsCanvasAdapter($renderer);
        $adapter->lineTo(50, 30);
    }

    public function testCurrentPointUpdatesAfterLineTo()
    {
        $mockRenderer = $this->createMock(ModernGraphicsRenderer::class);
        $adapter = new ModernGraphicsCanvasAdapter($mockRenderer);

        $adapter->moveTo(10, 20);
        $adapter->lineTo(30, 40);

        $reflection = new ReflectionClass($adapter);
        $currentPoint = $reflection->getProperty('currentPoint');

        $this->assertEquals(new Point(30, 40), $currentPoint->getValue($adapter));
    }
}
