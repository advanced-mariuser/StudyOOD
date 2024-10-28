<?php

require_once 'ArgumentParser/CArgumentParser.php';
require_once 'Transformer/CTransformer.php';

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
