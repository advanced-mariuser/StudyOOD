<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Shape/GroupShape.php';
require_once __DIR__ . '/../src/Shape/Rectangle.php';
require_once __DIR__ . '/../src/Shape/Ellipse.php';
require_once __DIR__ . '/../src/RGBAColor.php';
require_once __DIR__ . '/../src/Rect.php';
require_once __DIR__ . '/../src/Canvas/CanvasInterface.php';

class GroupShapeTests extends TestCase
{
    public function testAddShapeIncreasesShapeCount(): void
    {
        $groupShape = new GroupShape();
        $rectangle = new Rectangle(new Rect(0, 0, 100, 50), new Style());

        $groupShape->addShape($rectangle);

        $this->assertEquals(1, $groupShape->getShapeCount());
    }

    public function testRemoveShapeDecreasesShapeCount(): void
    {
        $groupShape = new GroupShape();
        $rectangle = new Rectangle(new Rect(0, 0, 100, 50), new Style());

        $groupShape->addShape($rectangle);
        $groupShape->removeShapeAtIndex(0);

        $this->assertEquals(0, $groupShape->getShapeCount());
    }

    public function testRemoveShapeAtInvalidIndexThrowsError(): void
    {
        $this->expectException(\OutOfBoundsException::class);

        $groupShape = new GroupShape();
        $groupShape->removeShapeAtIndex(0);
    }

    public function testGetShapeAtInvalidIndexThrowsError(): void
    {
        $this->expectException(\TypeError::class);

        $groupShape = new GroupShape();
        $groupShape->getShapeAtIndex(0);
    }

    public function testUpdateFrameCalculatesCorrectFrame(): void
    {
        $groupShape = new GroupShape();
        $rectangle1 = new Rectangle(new Rect(10, 20, 100, 50), new Style());
        $rectangle2 = new Rectangle(new Rect(50, 10, 150, 70), new Style());

        $groupShape->addShape($rectangle1);
        $groupShape->addShape($rectangle2);

        $frame = $groupShape->getFrame();

        $this->assertEquals(10, $frame->left);
        $this->assertEquals(10, $frame->top);
        $this->assertEquals(190, $frame->width);
        $this->assertEquals(70, $frame->height);
    }

    public function testGetFrameWhenNoShapesReturnsEmptyFrame(): void
    {
        $this->expectException(\TypeError::class);

        $groupShape = new GroupShape();
        $frame = $groupShape->getFrame();
    }

    public function testDrawCallsDrawOnAllShapes(): void
    {
        $mockCanvas = $this->createMock(CanvasInterface::class);
        $groupShape = new GroupShape();

        $rectangle = $this->createMock(Rectangle::class);
        $rectangle->method('getFrame')->willReturn(new Rect(0, 0, 100, 50));
        $rectangle->expects($this->once())->method('draw')->with($mockCanvas);

        $ellipse = $this->createMock(Ellipse::class);
        $ellipse->method('getFrame')->willReturn(new Rect(10, 10, 30, 20));
        $ellipse->expects($this->once())->method('draw')->with($mockCanvas);

        $groupShape->addShape($rectangle);
        $groupShape->addShape($ellipse);

        $groupShape->draw($mockCanvas);
    }

    public function testAddShapeUpdatesFrameCorrectly(): void
    {
        $groupShape = new GroupShape();
        $rectangle = new Rectangle(new Rect(10, 10, 50, 50), new Style());
        $ellipse = new Ellipse(new Rect(0, 0, 20, 20), new Style());

        $groupShape->addShape($rectangle);
        $groupShape->addShape($ellipse);

        $frame = $groupShape->getFrame();

        $this->assertEquals(0, $frame->left);
        $this->assertEquals(0, $frame->top);
        $this->assertEquals(60, $frame->width);
        $this->assertEquals(60, $frame->height);
    }

    public function testEmptyGroupShapeHasNoFrame(): void
    {
        $this->expectException(\TypeError::class);

        $groupShape = new GroupShape();
        $frame = $groupShape->getFrame();
    }

    //добавить тесты на фрейм когда есть две точки в разных углах и взять ф группы фрейм
}
