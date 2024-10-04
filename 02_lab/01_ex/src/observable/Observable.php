<?php
declare(strict_types=1);

require_once __DIR__ . '/ObservableInterface.php';
require_once __DIR__ . '/../observer/ObserverInterface.php';

class Observable implements ObservableInterface
{
    private array $observers = [];

    public function registerObserver(ObserverInterface $observer): void
    {
        $this->observers[] = $observer;
    }

    public function notifyObservers(): void
    {
        $data = $this->getChangedData();
        foreach ($this->observers as $observer)
        {
            $observer->update($data);
        }
    }

    public function removeObserver(ObserverInterface $observer): void
    {
        foreach ($this->observers as $key => $obs)
        {
            if ($obs === $observer)
            {
                unset($this->observers[$key]);
            }
        }
    }

    protected function getChangedData(): ?WeatherDataInfo
    {
        // Этот метод должен быть переопределен в подклассах
        return null;
    }
}