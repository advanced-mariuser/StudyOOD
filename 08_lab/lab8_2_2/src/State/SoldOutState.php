<?php
declare(strict_types=1);

require_once __DIR__ . '/StateInterface.php';

class SoldOutState implements StateInterface
{
    private GumballMachineInterface $gumballMachine;

    public function __construct(GumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        echo "You can't insert a quarter, the machine is sold out\n";
    }

    public function ejectQuarters(): void
    {
        if ($this->gumballMachine->getQuarterCount() > 0)
        {
            echo "Returning {$this->gumballMachine->getQuarterCount()} coins.\n";
            $this->gumballMachine->returnAllQuarters();
        }
        else
        {
            echo "No coins to return.\n";
        }
    }

    public function turnCrank(): void
    {
        echo "You turned but there's no gumballs\n";
    }

    public function dispense(): void
    {
        echo "No gumball dispensed\n";
    }

    public function refill(int $numGumballs): void
    {
        $this->gumballMachine->refill($numGumballs);
        echo "Machine refilled. Gumballs available: {$this->gumballMachine->getBallCount()}\n";
    }

    public function toString(): string
    {
        return "sold out";
    }
}
