<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/PictureDraft.php';
require_once __DIR__ . '/../src/Shapes/Shape.php';

class PictureDraftTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testAddShape()
    {
        $draft = new PictureDraft();
        $shape = $this->createMock(Shape::class);

        $draft->addShape($shape);

        $this->assertCount(1, $draft->getShapes());
        $this->assertSame($shape, $draft->getShapes()[0]);
    }
}