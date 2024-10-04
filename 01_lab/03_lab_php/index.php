<?php
declare(strict_types=1);

require_once __DIR__ . '/lib/Duck/MallardDuck.php';
require_once __DIR__ . '/lib/Duck/RedheadDuck.php';
require_once __DIR__ . '/lib/Duck/RubberDuck.php';
require_once __DIR__ . '/lib/Duck/DecoyDuck.php';
require_once __DIR__ . '/lib/Duck/ModelDuck.php';
require_once __DIR__ . '/lib/Duck/Fly/FlyBehavior.php';
require_once __DIR__ . '/lib/DuckFunctions.php';

$mallard = new MallardDuck();
playWithDuck($mallard);
playWithDuck($mallard);
playWithDuck($mallard);
playWithDuck($mallard);

$redhead = new RedheadDuck();
playWithDuck($redhead);

$rubberDuck = new RubberDuck();
playWithDuck($rubberDuck);

$decoyDuck = new DecoyDuck();
playWithDuck($decoyDuck);

$modelDuck = new ModelDuck();
playWithDuck($modelDuck);

$modelDuck->setFlyBehavior(flyWithWings());
playWithDuck($modelDuck);
