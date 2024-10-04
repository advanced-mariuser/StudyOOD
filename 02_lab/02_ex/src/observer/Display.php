<?php
declare(strict_types=1);

require_once __DIR__ . '/ObserverInterface.php';

class Display implements ObserverInterface
{
    public function update(WeatherDataInfo $data): void
    {
        echo "Current Temp: {$data->temperature}\n";
        echo "Current Hum: {$data->humidity}\n";
        echo "Current Pressure: {$data->pressure}\n";
        echo "----------------\n";
    }
}