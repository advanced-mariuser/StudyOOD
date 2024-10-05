<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/observer/Display.php';
require_once __DIR__ . '/../src/observer/StatsDisplay.php';
require_once __DIR__ . '/../src/observable/WeatherData.php';
require_once __DIR__ . '/../src/WeatherDataInfo.php';

class WeatherStationTest extends TestCase
{
    public function testObserversAreNotifiedInPriorityOrder(): void
    {
        // Arrange
        $weatherData = new WeatherData();
        $display1 = $this->createMock(ObserverInterface::class);
        $display2 = $this->createMock(ObserverInterface::class);
        $display3 = $this->createMock(ObserverInterface::class);

        $weatherDataInfo = new WeatherDataInfo(25.0, 65.0, 1012.0);

        $inOrder = $this->getMockBuilder(ObserverInterface::class)->getMock();
        $display3->expects($this->once())
            ->method('update')
            ->withAnyParameters()
            ->willReturnCallback(function () use ($inOrder, $weatherDataInfo) {
                $inOrder->update($weatherDataInfo);
            });
        $display1->expects($this->once())
            ->method('update')
            ->withAnyParameters()
            ->willReturnCallback(function () use ($inOrder, $weatherDataInfo) {
                $inOrder->update($weatherDataInfo);
            });
        $display2->expects($this->once())
            ->method('update')
            ->withAnyParameters()
            ->willReturnCallback(function () use ($inOrder, $weatherDataInfo) {
                $inOrder->update($weatherDataInfo);
            });

        $weatherData->registerObserver($display1, 2);
        $weatherData->registerObserver($display2, 1);
        $weatherData->registerObserver($display3, 3);

        $weatherData->setMeasurements(25.0, 65.0, 1012.0);
        $actualNotifiedObservers = $weatherData->getObservers();
        $expectedNotifiedObservers = [
            ['observer' => $display3, 'priority' => 3],
            ['observer' => $display2, 'priority' => 1],
            ['observer' => $display1, 'priority' => 2]
        ];

        $this->assertEquals($expectedNotifiedObservers, $actualNotifiedObservers);
    }

    public function testObserverNotResubscribed(): void
    {
        $weatherData = new WeatherData();
        $display = $this->createMock(ObserverInterface::class);

        $weatherData->registerObserver($display, 2);
        $weatherData->registerObserver($display, 1);

        $display->expects($this->once())->method('update');

        $weatherData->setMeasurements(25.0, 65.0, 1012.0);
    }

    public function testObserverCanBeRemoved(): void
    {
        $weatherData = new WeatherData();
        $display = $this->createMock(ObserverInterface::class);

        $weatherData->registerObserver($display, 2);
        $weatherData->removeObserver($display);

        $display->expects($this->never())->method('update');

        $weatherData->setMeasurements(25.0, 65.0, 1012.0);
    }

    private function wasNotifiedInPriorityOrder(array $expectedOrder, array $actualObservers): bool
    {
        $observedOrder = [];

        // Collect class names of actual observers in the order they were notified
        foreach ($actualObservers as $observer)
        {
            $observedOrder[] = get_class($observer);
        }

        // Compare expected order of observer class names
        foreach ($expectedOrder as $expectedObserver)
        {
            $expectedClassNames[] = get_class($expectedObserver);
        }

        return $observedOrder === $expectedClassNames;
    }
}
