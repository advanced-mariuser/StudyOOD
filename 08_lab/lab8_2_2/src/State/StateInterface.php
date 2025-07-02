<?php
declare(strict_types=1);

interface StateInterface
{
    public function insertQuarter(): void;
    public function ejectQuarters(): void;
    public function turnCrank(): void;
    public function dispense(): void;
    public function refill(int $numGumballs): void;
    public function toString(): string;
}
