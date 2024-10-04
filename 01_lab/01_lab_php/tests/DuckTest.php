<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once  __DIR__ . '/../vendor/autoload.php';
require_once  __DIR__ . '/../lib/Duck/Duck.php';
require_once  __DIR__ . '/../lib/Duck/RubberDuck.php';
require_once  __DIR__ . '/../lib/Duck/RedheadDuck.php';
require_once  __DIR__ . '/../lib/Duck/MallardDuck.php';
require_once  __DIR__ . '/../lib/Duck/DecoyDuck.php';
require_once  __DIR__ . '/../lib/Duck/Dance/WaltzDanceBehavior.php';
require_once  __DIR__ . '/../lib/Duck/Dance/MinuetDanceBehavior.php';
require_once  __DIR__ . '/../lib/Duck/Dance/FakeDanceBehavior.php';

class DuckTest extends TestCase
{
    public function testMallardDuck()
    {
        $waltzDanceMock = $this->createMock(WaltzDanceBehavior::class);
        $waltzDanceMock->expects($this->once())
            ->method('dance');

        $duck = new MallardDuck();

        $reflection = new ReflectionClass($duck);
        $danceProperty = $reflection->getProperty('danceBehavior');
        $danceProperty->setValue($duck, $waltzDanceMock);

        $duck->dance();
    }

    public function testRedheadDuck()
    {
        $minuetDanceMock = $this->createMock(MinuetDanceBehavior::class);
        $minuetDanceMock->expects($this->once())
            ->method('dance');

        $duck = new RedheadDuck();

        $reflection = new ReflectionClass($duck);
        $danceProperty = $reflection->getProperty('danceBehavior');
        $danceProperty->setValue($duck, $minuetDanceMock);

        $duck->dance();
    }

    public function testRubberDuck()
    {
        $fakeDanceMock = $this->createMock(FakeDanceBehavior::class);
        $fakeDanceMock->expects($this->once())
            ->method('dance');

        $duck = new RubberDuck();

        $reflection = new ReflectionClass($duck);
        $danceProperty = $reflection->getProperty('danceBehavior');
        $danceProperty->setValue($duck, $fakeDanceMock);

        $duck->dance();
    }

    public function testDecoyDuck()
    {
        $fakeDanceMock = $this->createMock(FakeDanceBehavior::class);
        $fakeDanceMock->expects($this->once())
            ->method('dance');

        $duck = new DecoyDuck();

        $reflection = new ReflectionClass($duck);
        $danceProperty = $reflection->getProperty('danceBehavior');
        $danceProperty->setValue($duck, $fakeDanceMock);

        $duck->dance();
    }
    //сделать тест не зависимым от вывода
}