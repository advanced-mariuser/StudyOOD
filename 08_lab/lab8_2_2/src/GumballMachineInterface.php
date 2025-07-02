<?php
declare(strict_types=1);

interface GumballMachineInterface
{
    public function releaseBall(): void;
    public function getBallCount(): int;
    public function returnAllQuarters(): void;
    public function getQuarterCount(): int;
    public function addQuarter(): void;

    public function setSoldOutState(): void;
    public function setNoQuarterState(): void;
    public function setSoldState(): void;
    public function setHasQuarterState(): void;
}
