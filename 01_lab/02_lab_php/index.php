<?php
declare(strict_types=1);

require_once __DIR__ . '/lib/Duck/DecoyDuck.php';
require_once __DIR__ . '/lib/Duck/MallardDuck.php';
require_once __DIR__ . '/lib/Duck/ModelDuck.php';
require_once __DIR__ . '/lib/Duck/RedheadDuck.php';
require_once __DIR__ . '/lib/Duck/RubberDuck.php';
require_once __DIR__ . '/lib/DuckFunctions.php';

$mallardDuck = new MallardDuck();
playWithDuck($mallardDuck);
playWithDuck($mallardDuck);
playWithDuck($mallardDuck);

playWithDuck($mallardDuck);

$redheadDuck = new RedheadDuck();
playWithDuck($redheadDuck);

$rubberDuck = new RubberDuck();
playWithDuck($rubberDuck);

$decoyDuck = new DecoyDuck();
playWithDuck($decoyDuck);

$modelDuck = new ModelDuck();
playWithDuck($modelDuck);

$modelDuck->setFlyBehavior(new FlyWithWings());
playWithDuck($modelDuck);
