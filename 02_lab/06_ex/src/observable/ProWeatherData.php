<?php

require_once __DIR__ . '/WeatherData.php';

class ProWeatherData extends WeatherData
{
    private ?float $windSpeed = null;
    private ?string $windDirection = null;

    public function setProMeasurements(float $temp, float $humidity, float $pressure, float $windSpeed, string $windDirection): void
    {
        $this->humidity = $humidity;
        $this->temperature = $temp;
        $this->pressure = $pressure;
        $this->windSpeed = $windSpeed;
        $this->windDirection = $windDirection;

        $this->measurementsChanged();
    }

    protected function getChangedData(): WeatherDataInfo
    {
        return new WeatherDataInfo(
            $this->getTemperature(),
            $this->getHumidity(),
            $this->getPressure(),
            'outdoor (PRO)',
            $this->windSpeed,
            $this->windDirection
        );
    }
}
