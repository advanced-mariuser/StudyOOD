<?php
declare(strict_types=1);

require_once __DIR__ . "/src/Beverages/BeverageInterface.php";
require_once __DIR__ . "/src/Beverages/Tea.php";
require_once __DIR__ . "/src/Beverages/Coffee.php";
require_once __DIR__ . "/src/Beverages/Latte.php";
require_once __DIR__ . "/src/Beverages/Milkshake.php";
require_once __DIR__ . "/src/Beverages/Cappuccino.php";
require_once __DIR__ . "/src/Condiments/Lemon.php";
require_once __DIR__ . "/src/Condiments/Cinnamon.php";
require_once __DIR__ . "/src/Condiments/IceCubes.php";
require_once __DIR__ . "/src/Condiments/ChocolateCrumbs.php";
require_once __DIR__ . "/src/Condiments/Syrup.php";
require_once __DIR__ . "/src/Condiments/CoconutFlakes.php";
require_once __DIR__ . "/src/Condiments/ChocolateSlice.php";
require_once __DIR__ . "/src/Condiments/Liqueur.php";
require_once __DIR__ . "/src/Condiments/Cream.php";

class CoffeeMachine
{
    private ?BeverageInterface $beverage = null;

    public function start(): void
    {
        echo "Welcome to the coffee shop! What would you like?\n";

        if (!$this->selectBeverage())
        {
            echo "Sorry, we don't serve this here\n";
            return;
        }

        echo "Your drink is coming right up.\n"
            . "We have a wide variety of different condiments, feel free to pick anything you like\n";

        while (true)
        {
            try
            {
                $result = $this->selectCondiment();
            } catch (Exception $e)
            {
                echo "I didn't quite get that..\n";
                return;
            }

            if ($result)
            {
                echo "And.. done! Anything else?\n";
            }
            else
            {
                break;
            }
        }

        echo "I guess that's all for now. Here's your beverage, enjoy!\n"
            . $this->beverage->getDescription() . ", cost: " . $this->beverage->getCost() . " RUB\n"
            . "Visit us again!\n";
    }

    private function selectBeverage(): bool
    {
        echo "1 - Cappuccino\n2 - Latte\n3 - Milkshake\n4 - Tea\n> ";
        $userChoice = (int)fgets(STDIN);

        return match ($userChoice)
        {
            1 => $this->selectCappuccino(),
            2 => $this->selectLatte(),
            3 => $this->selectMilkshake(),
            4 => $this->selectTea(),
            default => false,
        };
    }

    private function selectCappuccino(): bool
    {
        echo "1 - Standard, 2 - Double\n> ";
        $userChoice = (int)fgets(STDIN);

        return (bool)match ($userChoice)
        {
            1 => $this->beverage = new Cappuccino(CoffeePortion::Standard),
            2 => $this->beverage = new Cappuccino(CoffeePortion::Double),
            default => false,
        };
    }

    private function selectLatte(): bool
    {
        echo "1 - Standard, 2 - Double\n> ";
        $userChoice = (int)fgets(STDIN);

        return (bool)match ($userChoice)
        {
            1 => $this->beverage = new Latte(CoffeePortion::Standard),
            2 => $this->beverage = new Latte(CoffeePortion::Double),
            default => false,
        };
    }

    private function selectMilkshake(): bool
    {
        echo "1 - Small, 2 - Standard, 3 - Large\n> ";
        $userChoice = (int)fgets(STDIN);

        return (bool)match ($userChoice)
        {
            1 => $this->beverage = new Milkshake(MilkshakePortion::Small),
            2 => $this->beverage = new Milkshake(MilkshakePortion::Standard),
            3 => $this->beverage = new Milkshake(MilkshakePortion::Large),
            default => false,
        };
    }

    private function selectTea(): bool
    {
        echo "1 - Black, 2 - Green, 3 - Red, 4 - IvanChai\n> ";
        $userChoice = (int)fgets(STDIN);

        return (bool)match ($userChoice)
        {
            1 => $this->beverage = new Tea(TeaType::Black),
            2 => $this->beverage = new Tea(TeaType::Green),
            3 => $this->beverage = new Tea(TeaType::Red),
            4 => $this->beverage = new Tea(TeaType::IvanChai),
            default => false,
        };
    }

    private function selectCondiment(): bool
    {
        echo "1 - Chocolate crumbs\n2 - Cinnamon\n"
            . "3 - Coconut flakes\n4 - Ice cubes\n"
            . "5 - Lemon\n6 - Syrup\n7 - Liqueur \n"
            . "8- Chocolate slices\n9 - Cream\n> "
            . "10 - That's all\n> ";
        $userChoice = (int)fgets(STDIN);

        return match ($userChoice)
        {
            1 => $this->addChocolateCrumbs(),
            2 => $this->addCondiment(Cinnamon::class),
            3 => $this->addCoconutFlakes(),
            4 => $this->addIceCubes(),
            5 => $this->addLemon(),
            6 => $this->addSyrup(),
            7 => $this->addLiqueur(),
            8 => $this->addChocolateSlices(),
            9 => $this->addCream(),
            10 => false,
            default => false,
        };
    }

    private function addCondiment(string $condimentClass, ...$args): bool
    {
        $this->beverage = new $condimentClass($this->beverage, ...$args);
        return true;
    }

    private function addChocolateCrumbs(): bool
    {
        echo "How many grams?\n> ";
        $mass = (int)fgets(STDIN);
        return $this->addCondiment(ChocolateCrumbs::class, $mass);
    }

    private function addCoconutFlakes(): bool
    {
        echo "How many grams?\n> ";
        $mass = (int)fgets(STDIN);
        return $this->addCondiment(CoconutFlakes::class, $mass);
    }

    private function addIceCubes(): bool
    {
        echo "1 - Dry, 2 - Water\n> ";
        $typeChoice = (int)fgets(STDIN);
        $type = match ($typeChoice)
        {
            1 => IceCubeType::Dry,
            2 => IceCubeType::Water,
            default => throw new Exception("Invalid choice"),
        };

        echo "How many cubes?\n> ";
        $quantity = (int)fgets(STDIN);
        return $this->addCondiment(IceCubes::class, $quantity, $type);
    }

    private function addLemon(): bool
    {
        echo "How many slices?\n> ";
        $quantity = (int)fgets(STDIN);
        return $this->addCondiment(Lemon::class, $quantity);
    }

    private function addSyrup(): bool
    {
        echo "1 - Chocolate, 2 - Maple\n> ";
        $typeChoice = (int)fgets(STDIN);
        $type = match ($typeChoice)
        {
            1 => SyrupType::Chocolate,
            2 => SyrupType::Maple,
            default => throw new Exception("Invalid choice"),
        };

        return $this->addCondiment(Syrup::class, $type);
    }

    private function addCream(): bool
    {
        return $this->addCondiment(Cream::class);
    }

    private function addChocolateSlices(): bool
    {
        echo "How many slices? (max 5)\n> ";
        $quantity = (int)fgets(STDIN);
        return $this->addCondiment(ChocolateSlice::class, $quantity);
    }

    private function addLiqueur(): bool
    {
        echo "1 - Chocolate, 2 - Nutty\n> ";
        $typeChoice = (int)fgets(STDIN);
        $type = match ($typeChoice)
        {
            1 => LiqueurType::Chocolate,
            2 => LiqueurType::Nutty,
            default => throw new Exception("Invalid choice"),
        };

        return $this->addCondiment(Liqueur::class, $type);
    }
}

$coffeeShop = new CoffeeMachine();
$coffeeShop->start();