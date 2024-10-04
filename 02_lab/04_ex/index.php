<?php
declare(strict_types=1);

require_once __DIR__ . '/src/observable/WeatherData.php';
require_once __DIR__ . '/src/observer/StatsDisplay.php';
require_once __DIR__ . '/src/observer/Display.php';

$indoorWeatherData = new WeatherData('indoor');
$outdoorWeatherData = new WeatherData('outdoor');

$display = new Display();
$statsDisplay = new StatsDisplay();

$indoorWeatherData->registerObserver($display, 1);
$outdoorWeatherData->registerObserver($display, 1);

$indoorWeatherData->registerObserver($statsDisplay, 2);
$outdoorWeatherData->registerObserver($statsDisplay, 2);


echo "Indoor Station Data Update:\n";
$indoorWeatherData->setMeasurements(22.5, 55.0, 1010);

echo "Outdoor Station Data Update:\n";
$outdoorWeatherData->setMeasurements(30.0, 45.0, 1005);

$indoorWeatherData->setMeasurements(21.0, 58.0, 1012);
$outdoorWeatherData->setMeasurements(32.0, 40.0, 1000);