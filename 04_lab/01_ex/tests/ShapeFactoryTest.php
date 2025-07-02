<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Shape\Ellipse;
use Shape\Rectangle;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/ShapeFactory/ShapeFactory.php';
require_once __DIR__ . '/../src/Shapes/Rectangle.php';
require_once __DIR__ . '/../src/Shapes/Ellipse.php';
require_once __DIR__ . '/../src/Shapes/Triangle.php';
require_once __DIR__ . '/../src/Shapes/RegularPolygon.php';
require_once __DIR__ . '/../src/Shapes/Color.php';

class ShapeFactoryTest extends TestCase
{
    public function testCreateRectangle()
    {
        $factory = new ShapeFactory();

        $shape = $factory->createShape("rectangle green 0 0 100 50");

        $this->assertInstanceOf(Rectangle::class, $shape);
        $this->assertEquals(Color::Green, $shape->getColor());
    }

    public function testCreateEllipse()
    {
        $factory = new ShapeFactory();

        $shape = $factory->createShape("ellipse red 100 50 50 25");

        $this->assertInstanceOf(Ellipse::class, $shape);
        $this->assertEquals(Color::Red, $shape->getColor());
    }

    public function testCreateTriangle()
    {
        $factory = new ShapeFactory();

        $shape = $factory->createShape("triangle blue 0 0 50 100 100 0");

        $this->assertInstanceOf(Triangle::class, $shape);
        $this->assertEquals(Color::Blue, $shape->getColor());
    }

    public function testCreatePolygon()
    {
        $factory = new ShapeFactory();

        $shape = $factory->createShape("polygon yellow 50 50 5 50");

        $this->assertInstanceOf(RegularPolygon::class, $shape);
        $this->assertEquals(Color::Yellow, $shape->getColor());
    }
}
