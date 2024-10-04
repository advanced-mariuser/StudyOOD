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
        // Create two weather stations: indoor and outdoor
        $indoorWeatherData = new WeatherData('indoor');
        $outdoorWeatherData = new WeatherData('outdoor');

        // Create observers
        $display = new Display();
        $statsDisplay = new StatsDisplay();

        // Register observers to both weather stations
        $indoorWeatherData->registerObserver($display, 1);
        $outdoorWeatherData->registerObserver($display, 1);

        $indoorWeatherData->registerObserver($statsDisplay, 2);
        $outdoorWeatherData->registerObserver($statsDisplay, 2);

        // Simulate data changes for indoor station
        echo "Indoor Station Data Update:\n";
        $indoorWeatherData->setMeasurements(22.5, 55.0, 1010);

        // Simulate data changes for outdoor station
        echo "Outdoor Station Data Update:\n";
        $outdoorWeatherData->setMeasurements(30.0, 45.0, 1005);
    }
}