<?php
declare(strict_types=1);

require_once __DIR__ . '/StateInterface.php';

class NoQuarterState implements StateInterface
{
    private GumballMachineInterface $gumballMachine;

    public function __construct(GumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        echo "You inserted a quarter\n";
        $this->gumballMachine->addQuarter();
        $this->gumballMachine->setHasQuarterState();
    }

    public function ejectQuarters(): void
    {
        echo "You haven't inserted a quarter\n";
    }

    public function turnCrank(): void
    {
        echo "You turned but there's no quarter\n";
    }

    public function dispense(): void
    {
        echo "You need to pay first\n";
    }

    public function refill(int $numGumballs): void
    {
        $this->gumballMachine->refill($numGumballs);
        echo "Machine refilled. Gumballs available: {$this->gumballMachine->getBallCount()}\n";
    }

    public function toString(): string
    {
        return "waiting for quarter";
    }
}
