<?php

require_once __DIR__ . '/src/ModernGraphicsCanvasAdapter.php';
require_once __DIR__ . '/src/functions.php';

use app as application;

$userInput = trim(fgets(STDIN));

if (strtolower($userInput) === 'y')
{
    // Используем modern_graphics_lib через адаптер
    application\paintPictureOnModernGraphicsRenderer();
}
else
{
    // Используем graphics_lib напрямую
    application\paintPictureOnCanvas();
}