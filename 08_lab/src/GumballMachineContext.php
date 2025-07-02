<?php
declare(strict_types=1);

require_once __DIR__ . '/GumballMachineInterface.php';
require_once __DIR__ . '/State/StateInterface.php';

class GumballMachineContext implements GumballMachineInterface
{
    private int $count;
    private StateInterface $soldState;
    private StateInterface $soldOutState;
    private StateInterface $noQuarterState;
    private StateInterface $hasQuarterState;
    private StateInterface $state;

    public function __construct(int $numBalls)
    {
        $soldState = new SoldState($this);
        $soldOutState = new SoldOutState($this);
        $noQuarterState = new NoQuarterState($this);
        $hasQuarterState = new HasQuarterState($this);

        $this->count = $numBalls;
        $this->soldState = $soldState;
        $this->soldOutState = $soldOutState;
        $this->noQuarterState = $noQuarterState;
        $this->hasQuarterState = $hasQuarterState;

        $this->state = $this->count > 0 ? $this->noQuarterState : $this->soldOutState;
    }

    public function releaseBall(): void
    {
        if ($this->count > 0)
        {
            echo "A gumball comes rolling out the slot...\n";
            $this->count--;
        }
    }

    public function getBallCount(): int
    {
        return $this->count;
    }

    public function setSoldOutState(): void
    {
        $this->state = $this->soldOutState;
    }

    public function setNoQuarterState(): void
    {
        $this->state = $this->noQuarterState;
    }

    public function setSoldState(): void
    {
        $this->state = $this->soldState;
    }

    public function setHasQuarterState(): void
    {
        $this->state = $this->hasQuarterState;
    }

    public function getState(): StateInterface
    {
        return $this->state;
    }

    public function refill(int $numBalls): void
    {
        if ($numBalls <= 0)
        {
            echo "Refill failed: Cannot add zero or negative gumballs.\n";
            return;
        }

        $this->count += $numBalls;
        echo "Refilled with $numBalls gumballs. Current count: $this->count.\n";

        if ($this->count > 0 && $this->state === $this->soldOutState)
        {
            $this->state = $this->noQuarterState;
        }
    }
}
