<?php
declare(strict_types=1);

function flyWithWings(): callable
{
    $count = 0; // Счетчик полетов

    return function () use (&$count) {
        $count++;
        return "I'm flying with wings!!\nI's my {$count} flying!\n";
    };
}

function flyNoWay(): callable
{
    return function () {
    };
}
