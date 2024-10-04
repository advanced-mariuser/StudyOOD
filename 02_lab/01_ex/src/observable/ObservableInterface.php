<?php
declare(strict_types=1);

require_once __DIR__ . '/../observer/ObserverInterface.php';

interface ObservableInterface
{
    public function registerObserver(ObserverInterface $observer): void;

    public function notifyObservers(): void;

    public function removeObserver(ObserverInterface $observer): void;
}