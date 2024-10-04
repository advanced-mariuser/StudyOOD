<?php
declare(strict_types=1);

require_once __DIR__ . '/Duck/Duck.php';

function drawDuck(Duck $duck): void
{
    $duck->display();
}

function playWithDuck(Duck $duck): void
{
    drawDuck($duck);
    $duck->quack();
    $duck->fly();
    $duck->dance();
    echo "\n";
}
