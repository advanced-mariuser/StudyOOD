<?php
declare(strict_types=1);

class WeatherDataInfo
{
    public function __construct(
        public float $temperature = 0,
        public float $humidity = 0,
        public float $pressure = 0,
        public ?float $windSpeed = null,
        public ?string $windDirection = null
    )
    {
    }
}