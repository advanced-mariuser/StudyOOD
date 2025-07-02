<?php
declare(strict_types=1);

require_once __DIR__ . '/GumballMachineInterface.php';
require_once __DIR__ . '/GumballMachineContext.php';
require_once __DIR__ . '/State/SoldState.php';
require_once __DIR__ . '/State/SoldOutState.php';
require_once __DIR__ . '/State/HasQuarterState.php';
require_once __DIR__ . '/State/NoQuarterState.php';

class GumballMachine
{
    private GumballMachineInterface $baseMachine;

    public function __construct(int $numBalls)
    {
        $this->baseMachine = new GumballMachineContext($numBalls);
    }

    public function insertQuarter(): void
    {
        $this->baseMachine->getState()->insertQuarter();
    }

    public function ejectQuarter(): void
    {
        $this->baseMachine->getState()->ejectQuarter();
    }

    public function turnCrank(): void
    {
        $this->baseMachine->getState()->turnCrank();
        $this->baseMachine->getState()->dispense();
    }

    public function refill(int $numBalls): void
    {
        $this->baseMachine->refill($numBalls);
    }

    public function getBallCount(): int
    {
        return $this->baseMachine->getBallCount();
    }

    public function toString(): string
    {
        return sprintf(
            "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2024\nInventory: %d gumball(s)\nMachine is %s\n",
            $this->baseMachine->getBallCount(),
            $this->baseMachine->getState()->toString()
        );
    }
}
