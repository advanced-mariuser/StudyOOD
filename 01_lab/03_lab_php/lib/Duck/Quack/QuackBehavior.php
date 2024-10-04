<?php
declare(strict_types=1);

function quack(): callable
{
    return function () {
        echo "Quack Quack!!!\n";
    };
}

function squeak(): callable
{
    return function () {
        echo "Squeek!!!\n";
    };
}

function muteQuack(): callable
{
    return function () {
    };
}

function isQuacking(callable $behavior): bool
{
    return $behavior === quack();
}

function isSqueak(callable $behavior): bool
{
    return $behavior === squeak();
}

function isMuteQuack(callable $behavior): bool
{
    return $behavior === muteQuack();
}

function isSameBehavior(\Closure  $behavior1, \Closure  $behavior2): bool
{
    return spl_object_hash($behavior1) === spl_object_hash($behavior2);
}
