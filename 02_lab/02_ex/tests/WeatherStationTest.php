<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/observer/Display.php';
require_once __DIR__ . '/../src/observer/StatsDisplay.php';
require_once __DIR__ . '/../src/observable/WeatherData.php';

class WeatherStationTest extends TestCase
{
    public function testObserverRemovalDuringNotification()
    {
        $wd = new WeatherData();
        $display = new Display();
        $wd->registerObserver($display);
        $mockObserver = $this->createMock(ObserverInterface::class);
        $mockObserver->expects($this->once())
            ->method('update')
            ->willReturnCallback(function () use ($wd, $mockObserver) {
                $wd->removeObserver($mockObserver);
            });

        $wd->registerObserver($mockObserver);
        $wd->setMeasurements(3, 0.7, 760);

        $this->assertNotContains($mockObserver, $wd->getObservers());
    }
}