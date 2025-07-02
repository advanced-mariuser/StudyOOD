<?php
declare(strict_types=1);

class NaiveGumballMachine
{
    private const string STATE_SOLD_OUT = 'SoldOut';
    private const string STATE_NO_QUARTER = 'NoQuarter';
    private const string STATE_HAS_QUARTER = 'HasQuarter';
    private const string STATE_SOLD = 'Sold';
    private const int MAX_COINS = 5;

    private int $gumballCount;
    private int $coinCount = 0;
    private string $state;

    public function __construct(int $gumballCount)
    {
        $this->gumballCount = $gumballCount;
        $this->state = $gumballCount > 0 ? self::STATE_NO_QUARTER : self::STATE_SOLD_OUT;
    }

    public function insertQuarter(): void
    {
        switch ($this->state)
        {
            case self::STATE_SOLD_OUT:
                echo "You can't insert a coin; the machine is sold out.\n";
                break;

            case self::STATE_NO_QUARTER:
            case self::STATE_HAS_QUARTER:
                if ($this->coinCount < self::MAX_COINS)
                {
                    $this->coinCount++;
                    echo "Coin inserted. Total coins: {$this->coinCount}\n";
                    $this->state = self::STATE_HAS_QUARTER;
                }
                else
                {
                    echo "Cannot insert more coins. Maximum of " . self::MAX_COINS . " coins allowed.\n";
                }
                break;

            case self::STATE_SOLD:
                echo "Please wait; we're already giving you a gumball.\n";
                break;
        }
    }

    public function turnCrank(): void
    {
        switch ($this->state)
        {
            case self::STATE_SOLD_OUT:
                echo "You turned, but there are no gumballs.\n";
                break;

            case self::STATE_NO_QUARTER:
                echo "You turned, but there's no coin.\n";
                break;

            case self::STATE_HAS_QUARTER:
                echo "You turned...\n";
                $this->dispense();
                break;

            case self::STATE_SOLD:
                echo "Turning twice doesn't get you another gumball.\n";
                break;
        }
    }

    public function returnCoins(): void
    {
        if ($this->coinCount > 0)
        {
            echo "Returning {$this->coinCount} coin(s).\n";
            $this->coinCount = 0;

            if ($this->state === self::STATE_HAS_QUARTER)
            {
                $this->state = self::STATE_NO_QUARTER;
            }
        }
        else
        {
            echo "No coins to return.\n";
        }
    }

    public function refill(int $numGumballs): void
    {
        $this->gumballCount += $numGumballs;
        echo "Machine refilled. Gumballs available: {$this->gumballCount}\n";

        if ($this->gumballCount > 0 && $this->state === self::STATE_SOLD_OUT)
        {
            $this->state = $this->coinCount > 0 ? self::STATE_HAS_QUARTER : self::STATE_NO_QUARTER;
        }
    }

    public function getStatus(): void
    {
        $stateDescription = match ($this->state)
        {
            self::STATE_SOLD_OUT => 'Sold out',
            self::STATE_NO_QUARTER => 'Waiting for a coin',
            self::STATE_HAS_QUARTER => 'Waiting for crank turn',
            self::STATE_SOLD => 'Dispensing a gumball',
        };

        echo "Gumballs: {$this->gumballCount}, Coins: {$this->coinCount}, State: {$stateDescription}\n";
    }

    private function dispense(): void
    {
        if ($this->coinCount > 0 && $this->gumballCount > 0)
        {
            $this->gumballCount--;
            $this->coinCount--;
            echo "A gumball comes rolling out the slot!\n";

            if ($this->gumballCount === 0)
            {
                echo "Oops, out of gumballs.\n";
                $this->state = self::STATE_SOLD_OUT;
            }
            elseif ($this->coinCount === 0)
            {
                $this->state = self::STATE_NO_QUARTER;
            }
            else
            {
                $this->state = self::STATE_HAS_QUARTER;
            }
        }
        elseif ($this->gumballCount === 0)
        {
            echo "No gumball dispensed.\n";
            $this->state = self::STATE_SOLD_OUT;
        }
    }
}
