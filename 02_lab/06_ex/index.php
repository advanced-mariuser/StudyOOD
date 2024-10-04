<?php
declare(strict_types=1);

require_once __DIR__ . '/src/observable/ProWeatherData.php';
require_once __DIR__ . '/src/observable/WeatherData.php';
require_once __DIR__ . '/src/observer/StatsDisplay.php';
require_once __DIR__ . '/src/observer/Display.php';

$indoorWeatherData = new WeatherData();

$outdoorProWeatherData = new ProWeatherData();

$display = new Display();
$statsDisplay = new StatsDisplay();

$indoorWeatherData->registerObserver($display, 1);
$outdoorProWeatherData->registerObserver($display, 1);

$indoorWeatherData->registerObserver($statsDisplay, 2);
$outdoorProWeatherData->registerObserver($statsDisplay, 2);

echo "Indoor Station Data Update:\n";
$indoorWeatherData->setMeasurements(22.5, 55.0, 1010);

echo "Outdoor Pro Station Data Update:\n";
$outdoorProWeatherData->setProMeasurements(30.0, 45.0, 1005, 5.5, 'NE');