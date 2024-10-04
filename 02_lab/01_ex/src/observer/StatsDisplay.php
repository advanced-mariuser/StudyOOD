<?php
declare(strict_types=1);

require_once __DIR__ . '/ObserverInterface.php';

class StatsDisplay implements ObserverInterface
{
    private array $stats = [
        'temperature' => ['min' => INF, 'max' => -INF, 'sum' => 0, 'count' => 0],
        'humidity' => ['min' => INF, 'max' => -INF, 'sum' => 0, 'count' => 0],
        'pressure' => ['min' => INF, 'max' => -INF, 'sum' => 0, 'count' => 0],
    ];

    public function update(WeatherDataInfo $data): void
    {
        $this->updateStats('temperature', $data->temperature);
        $this->updateStats('humidity', $data->humidity);
        $this->updateStats('pressure', $data->pressure);

        $this->displayStats();
    }

    private function updateStats(string $type, float $value): void
    {
        if ($this->stats[$type]['min'] > $value)
        {
            $this->stats[$type]['min'] = $value;
        }
        if ($this->stats[$type]['max'] < $value)
        {
            $this->stats[$type]['max'] = $value;
        }

        $this->stats[$type]['sum'] += $value;
        ++$this->stats[$type]['count'];
    }

    private function displayStats(): void
    {
        foreach ($this->stats as $type => $stat)
        {
            if ($stat['count'] > 0)
            {
                echo ucfirst($type) . " Max: {$stat['max']}\n";
                echo ucfirst($type) . " Min: {$stat['min']}\n";
                echo ucfirst($type) . " Average: " . ($stat['sum'] / $stat['count']) . "\n";
            }
        }
        echo "----------------\n";
    }
}