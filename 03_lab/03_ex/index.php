<?php

require_once __DIR__ . '/src/ArgumentParser.php';
require_once __DIR__ . '/src/Transformer.php';

try {
    $argc = $GLOBALS['argc'];
    $argv = $GLOBALS['argv'];

    $parser = new ArgumentParser($argc, $argv);
    $args = $parser->parse();

    $transformer = new Transformer($args);
    $transformer->transform();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
