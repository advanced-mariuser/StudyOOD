<?php
declare(strict_types=1);

require_once __DIR__ . '/BeverageInterface.php';

abstract class Beverage implements BeverageInterface
{
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function add(callable $decorate): BeverageInterface {
        return $decorate($this);
    }
}