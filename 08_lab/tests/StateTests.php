<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/GumballMachine.php';

class StateTests extends TestCase
{
    private GumballMachine $machine;

    protected function setUp(): void
    {
        $this->machine = new GumballMachine(2);
    }

    public function testSoldState(): void
    {
        $this->machine->insertQuarter();
        $this->machine->turnCrank();

        $this->expectOutputString("You inserted a quarter\nYou turned...\nA gumball comes rolling out the slot...\n");

        $this->assertStringContainsString(
            "waiting for quarter",
            $this->machine->toString(),
            "После выдачи шарика должно быть состояние 'NoQuarterState'"
        );
    }

    public function testSoldOutState(): void
    {
        $this->machine->insertQuarter();
        $this->machine->turnCrank();
        $this->machine->insertQuarter();
        $this->machine->turnCrank();

        $this->machine->insertQuarter();

        $this->expectOutputString(
            "You inserted a quarter\nYou turned...\n".
            "A gumball comes rolling out the slot...\n".
            "You inserted a quarter\nYou turned...\n".
            "A gumball comes rolling out the slot...\n".
            "Oops, out of gumballs\n".
            "You can't insert a quarter, the machine is sold out\n"
        );

        $this->assertStringContainsString(
            "sold out",
            $this->machine->toString(),
            "Машина должна быть в состоянии 'SoldOutState', если шариков больше нет."
        );
    }

    public function testNoQuarterState(): void
    {
        $this->machine->turnCrank();

        $this->expectOutputString(
            "You turned but there's no quarter\nYou need to pay first\n"
        );

        $this->assertStringContainsString(
            "waiting for quarter",
            $this->machine->toString(),
            "Машина должна быть в состоянии 'NoQuarterState' до вставки монеты."
        );
    }

    public function testHasQuarterState(): void
    {
        $this->machine->insertQuarter();

        $this->machine->insertQuarter();

        $this->expectOutputString(
            "You inserted a quarter\nYou can't insert another quarter\n"
        );

        $this->assertStringContainsString(
            "waiting for turn of crank",
            $this->machine->toString(),
            "После вставки монеты машина должна быть в состоянии 'HasQuarterState'."
        );
    }

    public function testTransitionBetweenStates(): void
    {
        $this->machine->insertQuarter();
        $this->machine->turnCrank();

        $this->expectOutputString(
            "You inserted a quarter\nYou turned...\nA gumball comes rolling out the slot...\n"
        );

        $this->assertStringContainsString(
            "waiting for quarter",
            $this->machine->toString(),
            "После выдачи шарика машина должна вернуться в 'NoQuarterState'."
        );
    }
}

