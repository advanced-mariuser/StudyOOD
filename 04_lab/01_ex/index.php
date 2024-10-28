<?php

require_once __DIR__ . '/src/Client.php';
require_once __DIR__ . '/src/Designer/Designer.php';
require_once __DIR__ . '/src/Painter.php';
require_once __DIR__ . '/src/Canvas/SVG.php';

$factory = new ShapeFactory();
$designer = new Designer($factory);
$painter = new Painter();
$canvas = new SVGCanvas();

$client = new Client($designer, $painter, $canvas);
$client->run();