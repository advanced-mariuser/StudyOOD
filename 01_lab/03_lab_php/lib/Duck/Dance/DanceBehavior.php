<?php
declare(strict_types=1);

function waltzDance(): callable
{
    return function () {
        echo "I can dance waltz!\n";
    };
}

function minuetDance(): callable
{
    return function () {
        echo "I can dance minuet!\n";
    };
}

function fakeDance(): callable
{
    return function () {
    };
}
