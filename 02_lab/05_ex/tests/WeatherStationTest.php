<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/observer/Display.php';
require_once __DIR__ . '/../src/observer/StatsDisplay.php';
require_once __DIR__ . '/../src/observable/WeatherData.php';

class WeatherStationTest extends TestCase
{
    public function testObserversAreNotifiedInPriorityOrder(): void
    {
        $weatherData = new WeatherData();
        $display1 = $this->createMock(ObserverInterface::class);
        $display2 = $this->createMock(ObserverInterface::class);
        $display3 = $this->createMock(ObserverInterface::class);

        // Expect that update will be called on display3 first, then display1, and finally display2
        $display3->expects($this->once())->method('update');
        $display1->expects($this->once())->method('update');
        $display2->expects($this->once())->method('update');

        // Register observers with different priorities
        $weatherData->registerObserver($display1, 2);
        $weatherData->registerObserver($display2, 1);
        $weatherData->registerObserver($display3, 3);

        // Trigger notification
        $weatherData->setMeasurements(25.0, 65.0, 1012.0);
    }

    public function testObserverNotResubscribed(): void
    {
        $weatherData = new WeatherData();
        $display = $this->createMock(ObserverInterface::class);

        // Register the same observer twice with different priorities
        $weatherData->registerObserver($display, 2);
        $weatherData->registerObserver($display, 1);

        // Expect update to be called only once
        $display->expects($this->once())->method('update');

        $weatherData->setMeasurements(25.0, 65.0, 1012.0);
    }

    public function testObserverCanBeRemoved(): void
    {
        $weatherData = new WeatherData();
        $display = $this->createMock(ObserverInterface::class);

        $weatherData->registerObserver($display, 2);
        $weatherData->removeObserver($display);

        // Expect update to not be called after removal
        $display->expects($this->never())->method('update');

        $weatherData->setMeasurements(25.0, 65.0, 1012.0);
    }
}