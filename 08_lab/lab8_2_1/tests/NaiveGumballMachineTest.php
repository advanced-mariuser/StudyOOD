<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/NaiveGumballMachine.php';

class NaiveGumballMachineTest extends TestCase
{
    public function testInsertCoin(): void
    {
        $machine = new NaiveGumballMachine(5);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $this->expectOutputString("Coin inserted. Total coins: 1\nCoin inserted. Total coins: 2\n");
    }

    public function testMaxCoinsLimit(): void
    {
        $machine = new NaiveGumballMachine(5);
        for ($i = 0; $i < 6; $i++)
        {
            $machine->insertQuarter();
        }
        $this->expectOutputString(
            "Coin inserted. Total coins: 1\n" .
            "Coin inserted. Total coins: 2\n" .
            "Coin inserted. Total coins: 3\n" .
            "Coin inserted. Total coins: 4\n" .
            "Coin inserted. Total coins: 5\n" .
            "Cannot insert more coins. Maximum of 5 coins allowed.\n"
        );
    }

    public function testTurnCrank(): void
    {
        $machine = new NaiveGumballMachine(3);
        $machine->insertQuarter();
        $machine->turnCrank();
        $this->expectOutputString("Coin inserted. Total coins: 1\nYou turned...\nA gumball comes rolling out the slot!\n");
    }

    public function testReturnCoins(): void
    {
        $machine = new NaiveGumballMachine(5);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->returnCoins();
        $this->expectOutputString(
            "Coin inserted. Total coins: 1\n" .
            "Coin inserted. Total coins: 2\n" .
            "Returning 2 coin(s).\n"
        );
    }

    public function testDispenseWithMoreCoinsThanBalls(): void
    {
        $machine = new NaiveGumballMachine(2);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->turnCrank();
        $machine->returnCoins();
        $this->expectOutputString(
            "Coin inserted. Total coins: 1\n" .
            "Coin inserted. Total coins: 2\n" .
            "Coin inserted. Total coins: 3\n" .
            "You turned...\n" .
            "A gumball comes rolling out the slot!\n" .
            "You turned...\n" .
            "A gumball comes rolling out the slot!\n" .
            "Oops, out of gumballs.\n" .
            "Returning 1 coin(s).\n"
        );
    }
}
