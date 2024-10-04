<?php
declare(strict_types=1);

require_once __DIR__ . '/Fly/FlyBehaviorInterface.php';
require_once __DIR__ . '/Quack/QuackBehaviorInterface.php';
require_once __DIR__ . '/Dance/DanceBehaviorInterface.php';

abstract class Duck
{
    protected FlyBehaviorInterface $flyBehavior;
    protected QuackBehaviorInterface $quackBehavior;
    protected DanceBehaviorInterface $danceBehavior;

    public function __construct(FlyBehaviorInterface $flyBehavior, QuackBehaviorInterface $quackBehavior, DanceBehaviorInterface $danceBehavior)
    {
        $this->setFlyBehavior($flyBehavior);
        $this->quackBehavior = $quackBehavior;
        $this->danceBehavior = $danceBehavior;
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
    }

    public function dance(): void
    {
        $this->danceBehavior->dance();
    }

    public function setFlyBehavior(FlyBehaviorInterface $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function setDanceBehavior(DanceBehaviorInterface $danceBehavior): void
    {
        $this->danceBehavior = $danceBehavior;
    }

    abstract public function display(): void;
}
