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

    public function ejectQuarter(): void
    {
        echo "You can't eject, you haven't inserted a quarter yet\n";
    }

    public function turnCrank(): void
    {
        echo "You turned but there's no gumballs\n";
    }

    public function dispense(): void
    {
        echo "No gumball dispensed\n";
    }

    public function toString(): string
    {
        return "sold out";
    }
}
