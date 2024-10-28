<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Designer/Designer.php';
require_once __DIR__ . '/../src/Shapes/Shape.php';
require_once __DIR__ . '/../src/ShapeFactory/ShapeFactoryInterface.php';

class DesignerTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testCreateDraft()
    {
        $factory = $this->createMock(ShapeFactoryInterface::class);
        $factory->expects($this->exactly(3))
            ->method('createShape')
            ->willReturn($this->createMock(Shape::class));

        $designer = new Designer($factory);

        $input = "rectangle green 0 0 100 50\n"
            . "ellipse red 100 50 50 25\n"
            . "triangle blue 0 0 50 100 100 0";

        $draft = $designer->createDraft($input);

        $this->assertCount(3, $draft->getShapes());
    }
}
