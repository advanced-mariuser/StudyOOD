<?php
declare(strict_types=1);

require_once __DIR__ . '/src/observable/ProWeatherData.php';
require_once __DIR__ . '/src/observer/StatsDisplay.php';
require_once __DIR__ . '/src/observer/Display.php';

$weatherData = new ProWeatherData();

$display = new Display();
$statsDisplay = new StatsDisplay();

$weatherData->registerObserver($display, 1);
$weatherData->registerObserver($statsDisplay, 2);

$weatherData->setMeasurements(22.5, 55.0, 1010);
$weatherData->setProMeasurements(30.0, 45.0, 1005, 5.5, 'NE');
