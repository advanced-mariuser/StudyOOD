<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../lib/Duck/Duck.php';
require_once __DIR__ . '/../lib/Duck/RubberDuck.php';
require_once __DIR__ . '/../lib/Duck/RedheadDuck.php';
require_once __DIR__ . '/../lib/Duck/MallardDuck.php';
require_once __DIR__ . '/../lib/Duck/DecoyDuck.php';
require_once  __DIR__ . '/../lib/Duck/Fly/FlyWithWings.php';
require_once  __DIR__ . '/../lib/Duck/Fly/FlyNoWay.php';
require_once  __DIR__ . '/../lib/Duck/Quack/QuackBehavior.php';
require_once  __DIR__ . '/../lib/Duck/Quack/MuteQuackBehavior.php';
require_once  __DIR__ . '/../lib/Duck/Quack/SqueakBehavior.php';

class DuckTest extends TestCase
{
    public function testMallardDuck()
    {
        $quackMock = $this->createMock(QuackBehavior::class);

        $quackMock->expects($this->exactly(2))
            ->method('quack');

        $duck = new MallardDuck();

        $reflection = new ReflectionClass($duck);
        $quackProperty = $reflection->getProperty('quackBehavior');
        $quackProperty->setValue($duck, $quackMock);

        $duck->fly();
        $duck->fly();
        $duck->fly();
        $duck->fly();
    }

    public function testRedheadDuck()
    {
        $quackMock = $this->createMock(QuackBehavior::class);

        $quackMock->expects($this->exactly(2))
            ->method('quack');

        $duck = new RedheadDuck();

        $reflection = new ReflectionClass($duck);
        $quackProperty = $reflection->getProperty('quackBehavior');
        $quackProperty->setValue($duck, $quackMock);

        $duck->fly();
        $duck->fly();
        $duck->fly();
        $duck->fly();
    }

    public function testRubberDuck()
    {
        $quackMock = $this->createMock(SqueakBehavior::class);

        $quackMock->expects($this->exactly(0))
            ->method('quack');

        $duck = new RubberDuck();

        $reflection = new ReflectionClass($duck);
        $quackProperty = $reflection->getProperty('quackBehavior');
        $quackProperty->setValue($duck, $quackMock);

        $duck->fly();
        $duck->fly();
    }

    public function testDecoyDuck()
    {
        $quackMock = $this->createMock(MuteQuackBehavior::class);

        $quackMock->expects($this->exactly(0))
            ->method('quack');

        $duck = new DecoyDuck();

        $reflection = new ReflectionClass($duck);
        $quackProperty = $reflection->getProperty('quackBehavior');
        $quackProperty->setValue($duck, $quackMock);

        $duck->fly();
        $duck->fly();
    }
}