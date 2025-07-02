<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/GumballMachine.php';

class GumballMachineTests extends TestCase
{
    public function testInitialSetupWithZeroBalls(): void
    {
        $machine = new GumballMachine(0);

        $this->assertEquals(
            0,
            $machine->getBallCount(),
            "При инициализации с 0 шариков количество шариков должно быть 0."
        );

        $this->assertEquals(
            "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2024\nInventory: 0 gumball(s)\nMachine is sold out\n",
            $machine->toString(),
            "Машина должна быть в состоянии 'SoldOutState', если шариков 0."
        );
    }

    public function testInsertQuarterWithZeroBalls(): void
    {
        $machine = new GumballMachine(0);

        $machine->insertQuarter();
        $this->expectOutputString("You can't insert a quarter, the machine is sold out\n");

        $this->assertEquals(
            "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2024\nInventory: 0 gumball(s)\nMachine is sold out\n",
            $machine->toString(),
            "Состояние машины не должно изменяться при попытке вставить монету в пустую машину."
        );
    }

    public function testRefillWithMaxCapacity(): void
    {
        $machine = new GumballMachine(0);

        $machine->refill(1000);

        $this->assertEquals(
            1000,
            $machine->getBallCount(),
            "После наполнения машина должна содержать указанное количество шариков."
        );

        $this->assertEquals(
            "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2024\nInventory: 1000 gumball(s)\nMachine is waiting for quarter\n",
            $machine->toString(),
            "После наполнения машина должна перейти в состояние 'NoQuarterState'."
        );
    }

    public function testTurnCrankWithoutQuarter(): void
    {
        $machine = new GumballMachine(1);

        $machine->turnCrank();

        $this->expectOutputString("You turned but there's no quarter\nYou need to pay first\n");

        $this->assertEquals(
            1,
            $machine->getBallCount(),
            "Количество шариков не должно уменьшаться, если ручка повернута без монеты."
        );
    }

    public function testEjectQuarterWithoutInsert(): void
    {
        $machine = new GumballMachine(1);

        $machine->ejectQuarter();

        $this->expectOutputString("You haven't inserted a quarter\n");

        $this->assertEquals(
            "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2024\nInventory: 1 gumball(s)\nMachine is waiting for quarter\n",
            $machine->toString(),
            "Состояние машины не должно изменяться при попытке вернуть монету, если она не вставлена."
        );
    }

    public function testTurnCrankWhenSoldOut(): void
    {
        $machine = new GumballMachine(0);

        $machine->turnCrank();

        $this->expectOutputString("You turned but there's no gumballs\nNo gumball dispensed\n");

        $this->assertEquals(
            "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2024\nInventory: 0 gumball(s)\nMachine is sold out\n",
            $machine->toString(),
            "Состояние машины не должно изменяться при попытке повернуть ручку в состоянии 'SoldOutState'."
        );
    }

    public function testMultipleQuarters(): void
    {
        $machine = new GumballMachine(1);

        $machine->insertQuarter();
        $machine->insertQuarter();

        $this->expectOutputString("You inserted a quarter\nYou can't insert another quarter\n");

        $this->assertEquals(
            "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2024\nInventory: 1 gumball(s)\nMachine is waiting for turn of crank\n",
            $machine->toString(),
            "Машина не должна принимать вторую монету в состоянии 'HasQuarterState'."
        );
    }

    public function testDispenseWithSingleBall(): void
    {
        $machine = new GumballMachine(1);

        $machine->insertQuarter();
        $machine->turnCrank();

        $this->assertEquals(
            0,
            $machine->getBallCount(),
            "Количество шариков должно уменьшиться до 0 после выдачи последнего шарика."
        );

        $this->assertEquals(
            "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2024\nInventory: 0 gumball(s)\nMachine is sold out\n",
            $machine->toString(),
            "После выдачи последнего шарика машина должна перейти в состояние 'SoldOutState'."
        );
    }

    public function testRefillAfterSoldOut(): void
    {
        $machine = new GumballMachine(1);

        $machine->insertQuarter();
        $machine->turnCrank();

        $this->assertStringContainsString("sold out", $machine->toString());

        $machine->refill(5);

        $this->assertEquals(
            5,
            $machine->getBallCount(),
            "После заполнения в пустой машине должно быть новое количество шариков."
        );

        $this->assertEquals(
            "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2024\nInventory: 5 gumball(s)\nMachine is waiting for quarter\n",
            $machine->toString(),
            "После заполнения машина должна быть в состоянии 'NoQuarterState'."
        );
    }

    public function testRefillPositive(): void
    {
        $machine = new GumballMachine(0);
        $this->assertEquals(0, $machine->getBallCount());
        $machine->refill(10);
        $this->assertEquals(10, $machine->getBallCount());
        $this->assertStringContainsString("waiting for quarter", $machine->toString());
    }

    public function testRefillZero(): void
    {
        $machine = new GumballMachine(0);
        $machine->refill(0);
        $this->assertEquals(0, $machine->getBallCount());
    }

    public function testRefillNegative(): void
    {
        $machine = new GumballMachine(0);
        $machine->refill(-5);
        $this->assertEquals(0, $machine->getBallCount());
    }

    public function testRefillFromNonEmpty(): void
    {
        $machine = new GumballMachine(5);
        $machine->refill(5);
        $this->assertEquals(10, $machine->getBallCount());
    }
}
