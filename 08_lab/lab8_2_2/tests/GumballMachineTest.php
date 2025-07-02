<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/GumballMachine.php';

class GumballMachineTest extends TestCase
{
    public function testInitialState(): void
    {
        $machine = new GumballMachine(5);

        $this->assertEquals(5, $machine->getBallCount());
        $this->assertEquals(0, $machine->getQuarterCount());
    }

    public function testInsertQuarter(): void
    {
        $machine = new GumballMachine(5);

        $machine->insertQuarter();
        $this->assertEquals(1, $machine->getQuarterCount());
        $this->assertStringContainsString("waiting for turn of crank", $machine->toString());
    }

    public function testInsertMaxQuarters(): void
    {
        $machine = new GumballMachine(5);

        for ($i = 0; $i < GumballMachine::MAX_COINS; $i++)
        {
            $machine->insertQuarter();
        }

        $this->assertEquals(GumballMachine::MAX_COINS, $machine->getQuarterCount());

        // Attempt to insert one more coin
        $machine->insertQuarter();

        $this->assertEquals(GumballMachine::MAX_COINS, $machine->getQuarterCount(), "Не должно превышать максимальное количество монет.");
    }

    public function testTurnCrankAndDispense(): void
    {
        $machine = new GumballMachine(5);

        $machine->insertQuarter();
        $machine->turnCrank();

        $this->assertEquals(4, $machine->getBallCount(), "Выдается одна жвачка.");
        $this->assertEquals(0, $machine->getQuarterCount(), "Все монеты должны быть израсходованы.");
        $this->assertStringContainsString("waiting for quarter", $machine->toString());
    }

    public function testInsertAndReturnCoins(): void
    {
        $machine = new GumballMachine(5);

        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->ejectQuarters();

        $this->assertEquals(0, $machine->getQuarterCount(), "Все монеты должны быть возвращены.");
        $this->assertStringContainsString("waiting for quarter", $machine->toString());
    }

    public function testSoldOutState(): void
    {
        $machine = new GumballMachine(1);

        $machine->insertQuarter();
        $machine->turnCrank();

        $this->assertEquals(0, $machine->getBallCount(), "No gumballs left.");
        $this->assertStringContainsString("sold out", $machine->toString());

        // Attempt to insert a coin
        $machine->insertQuarter();
        $this->assertEquals(0, $machine->getQuarterCount(), "No coins should be accepted when sold out.");
    }

    public function testRefill(): void
    {
        $machine = new GumballMachine(0);

        $machine->refill(10);
        $this->assertEquals(10, $machine->getBallCount(), "Machine should be refilled.");

        $this->assertStringContainsString("waiting for quarter", $machine->toString());

        $machine->insertQuarter();
        $this->assertStringContainsString("waiting for turn of crank", $machine->toString());
    }
}
