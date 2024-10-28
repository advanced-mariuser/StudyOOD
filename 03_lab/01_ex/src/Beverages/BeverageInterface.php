<?php
declare(strict_types=1);

interface BeverageInterface
{
    public function getDescription(): string;

    public function getCost(): float;
}