<?php
declare(strict_types=1);

class FunctionalFlyBehavior implements FlyBehaviorInterface
{
    public function __construct(callable fly, callable canFly, callable flightCounter)
    {

    }

    public function fly()
    {
        ($this->flyFn)();
    }
}

abstract class Duck
{
    private $flyBehavior;
    private $quackBehavior;
    private $danceBehavior;

    private int $flyCounter = 0;

    public function __construct(callable $flyBehavior, callable $quackBehavior, callable $danceBehavior)
    {
        $this->flyBehavior = $flyBehavior;
        $this->quackBehavior = $quackBehavior;
        $this->danceBehavior = $danceBehavior;
    }

    public function performFly(): void
    {
        ($this->flyBehavior)($this);

        $this->flyCounter++;
        echo "I's my {$this->flyCounter} flying!\n";

        if ($this->flyCounter % 2 == 0)
        {
            $this->performQuack();
        }
    }

    public function performQuack(): void
    {
        ($this->quackBehavior)();
    }

    public function performDance(): void
    {
        ($this->danceBehavior)();
    }

    public function setFlyBehavior(callable $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function setDanceBehavior(callable $danceBehavior): void
    {
        $this->danceBehavior = $danceBehavior;
    }
}
