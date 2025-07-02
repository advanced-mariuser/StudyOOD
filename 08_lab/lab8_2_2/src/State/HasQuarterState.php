<?php
declare(strict_types=1);

require_once __DIR__ . '/StateInterface.php';

class HasQuarterState implements StateInterface
{
    private GumballMachineInterface $gumballMachine;

    public function __construct(GumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        if ($this->gumballMachine->getQuarterCount() < GumballMachine::MAX_COINS)
        {
            $this->gumballMachine->addQuarter();
            echo "You inserted another coin. Total coins: {$this->gumballMachine->getQuarterCount()}\n";
        }
        else
        {
            echo "You can't insert more than " . GumballMachine::MAX_COINS . " coins.\n";
        }
    }

    public function ejectQuarters(): void
    {
        echo "Returning {$this->gumballMachine->getQuarterCount()} coins.\n";
        $this->gumballMachine->returnAllQuarters();
        $this->gumballMachine->setNoQuarterState();
    }

    public function turnCrank(): void
    {
        echo "You turned...\n";
        $this->gumballMachine->setSoldState();
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
        return "waiting for turn of crank";
    }
}
