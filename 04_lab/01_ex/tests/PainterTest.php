<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Painter.php';
require_once __DIR__ . '/../src/Canvas/CanvasInterface.php';
require_once __DIR__ . '/../src/Shapes/Shape.php';

class PainterTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testDrawPicture()
    {
        $canvas = $this->createMock(CanvasInterface::class);
        $draft = $this->createMock(PictureDraft::class);
        $shape = $this->createMock(Shape::class);

        $draft->method('getShapeCount')->willReturn(1);
        $draft->method('getShapes')->willReturn([$shape]);

        $shape->expects($this->once())
            ->method('draw')
            ->with($canvas);

        $painter = new Painter();
        $painter->drawPicture($draft, $canvas);
    }
}
