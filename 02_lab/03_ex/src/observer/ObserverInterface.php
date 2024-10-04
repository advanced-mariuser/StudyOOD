<?php
declare(strict_types=1);

require_once __DIR__ . '/../WeatherDataInfo.php';

interface ObserverInterface
{
    public function update(WeatherDataInfo $data): void;

    public function setPriority(int $priority): void;

    public function getPriority(): int;
}