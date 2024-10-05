<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/observer/Display.php';
require_once __DIR__ . '/../src/observer/StatsDisplay.php';
require_once __DIR__ . '/../src/observable/WeatherData.php';

class WeatherStationTest extends TestCase
{
    public function testWeatherStationDuo()
    {
        $indoorWeatherData = new WeatherData('indoor');
        $outdoorWeatherData = new WeatherData('outdoor');

        $display = $this->createMock(Display::class);
        $statsDisplay = $this->createMock(StatsDisplay::class);

        $display->expects($this->exactly(2))
            ->method('update')
            ->with($this->logicalOr(
                $this->callback(function ($data) {
                    return $data->getTemperature() === 22.5 && $data->getHumidity() === 55.0 && $data->getPressure() === 1010;
                }),
                $this->callback(function ($data) {
                    return $data->getTemperature() === 30.0 && $data->getHumidity() === 45.0 && $data->getPressure() === 1005;
                })
            ));

        $statsDisplay->expects($this->exactly(2))
            ->method('update')
            ->with($this->logicalOr(
                $this->callback(function ($data) {
                    return $data->getTemperature() === 22.5 && $data->getHumidity() === 55.0 && $data->getPressure() === 1010;
                }),
                $this->callback(function ($data) {
                    return $data->getTemperature() === 30.0 && $data->getHumidity() === 45.0 && $data->getPressure() === 1005;
                })
            ));

        $indoorWeatherData->registerObserver($display, 1);
        $outdoorWeatherData->registerObserver($display, 1);

        $indoorWeatherData->registerObserver($statsDisplay, 2);
        $outdoorWeatherData->registerObserver($statsDisplay, 2);

        echo "Indoor Station Data Update:\n";
        $indoorWeatherData->setMeasurements(22.5, 55.0, 1010);

        echo "Outdoor Station Data Update:\n";
        $outdoorWeatherData->setMeasurements(30.0, 45.0, 1005);
    }
}