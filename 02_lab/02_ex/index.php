<?php
declare(strict_types=1);

require_once __DIR__ . '/src/observable/WeatherData.php';
require_once __DIR__ . '/src/observer/StatsDisplay.php';
require_once __DIR__ . '/src/observer/Display.php';

$wd = new WeatherData();

$display = new Display();
$wd->registerObserver($display);

$statsDisplay = new StatsDisplay();
$wd->registerObserver($statsDisplay);

$wd->setMeasurements(3, 0.7, 760);
$wd->setMeasurements(4, 0.8, 761);
$wd->setMeasurements(2, 0.6, 759);
$wd->setMeasurements(5, 0.9, 762);

$wd->removeObserver($statsDisplay);

$wd->setMeasurements(10, 0.8, 761);
$wd->setMeasurements(-10, 0.8, 761);