<?php
declare(strict_types=1);

require_once __DIR__ . '/Fly/FlyBehaviorInterface.php';
require_once __DIR__ . '/Quack/QuackBehaviorInterface.php';

abstract class Duck
{
    protected FlyBehaviorInterface $flyBehavior;
    protected QuackBehaviorInterface $quackBehavior;

    private int $flyCounter = 0;

    public function __construct(FlyBehaviorInterface $flyBehavior, QuackBehaviorInterface $quackBehavior)
    {
        $this->setFlyBehavior($flyBehavior);
        $this->quackBehavior = $quackBehavior;
    }

    public function getQuackBehavior(): ?QuackBehaviorInterface
    {
        return $this->quackBehavior;
    }

    public function quack(): void
    {
        $this->quackBehavior->quack();
    }

    public function swim(): void
    {
        echo "I'm swimming\n";
    }

    public function fly(): void
    {
        $this->flyBehavior->fly();
        if ($this->flyBehavior instanceof FlyWithWings)
        {
            $this->flyCounter++;
            echo "I's my {$this->flyCounter} flying!\n";

            if ($this->getQuackBehavior() != null && $this->flyCounter % 2 == 0)
            {
                $this->quackBehavior->quack();
            }
        }
    }
// добавить метод canfly в интерфейс FlyBehaviour
    public function dance(): void
    {
        echo "I'm Dancing\n";
    }

    public function setFlyBehavior(FlyBehaviorInterface $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior;
    }

    abstract public function display(): void;
}
