<?php
declare(strict_types=1);

require_once __DIR__ . '/ObserverInterface.php';

class Display implements ObserverInterface
{
    private int $priority = 0;

    public function update(WeatherDataInfo $data): void
    {
        echo "Priority: {$this->priority}\n";
        echo "Current Temp: {$data->temperature}\n";
        echo "Current Hum: {$data->humidity}\n";
        echo "Current Pressure: {$data->pressure}\n";

        if ($data->windSpeed !== null && $data->windDirection !== null) {
            echo "Wind Speed: {$data->windSpeed} m/s\n";
            echo "Wind Direction: {$data->windDirection}\n";
        }

        echo "----------------\n";
    }

    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }
}