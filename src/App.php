<?php

use Battleship\GameController;
use Battleship\Position;
use Battleship\Letter;
use Battleship\Color;

class App
{
    private static $myFleet = array();
    private static $enemyFleet = array();
    private static $round = 1;
    private static $console;
    private static $lastPosition = null;
    private static $lastIsHit = null;

    static function run()
    {
        self::$console = new Console();
        self::$console->setForegroundColor(Color::MAGENTA);

        self::$console->println("                                     |__");
        self::$console->println("                                     |\\/");
        self::$console->println("                                     ---");
        self::$console->println("                                     / | [");
        self::$console->println("                              !      | |||");
        self::$console->println("                            _/|     _/|-++'");
        self::$console->println("                        +  +--|    |--|--|_ |-");
        self::$console->println("                     { /|__|  |/\\__|  |--- |||__/");
        self::$console->println("                    +---------------___[}-_===_.'____                 /\\");
        self::$console->println("                ____`-' ||___-{]_| _[}-  |     |_[___\\==--            \\/   _");
        self::$console->println(" __..._____--==/___]_|__|_____________________________[___\\==--____,------' .7");
        self::$console->println("|                        Welcome to Battleship                         BB-61/");
        self::$console->println(" \\_________________________________________________________________________|");
        self::$console->println();
        self::$console->resetForegroundColor();
        self::InitializeGame();
        self::StartGame();
    }

    public static function InitializeEnemyFleet()
    {
        self::$enemyFleet = GameController::initializeShips();

        array_push(self::$enemyFleet[0]->getPositions(), new Position('B', 4));
        array_push(self::$enemyFleet[0]->getPositions(), new Position('B', 5));
        array_push(self::$enemyFleet[0]->getPositions(), new Position('B', 6));
        array_push(self::$enemyFleet[0]->getPositions(), new Position('B', 7));
        array_push(self::$enemyFleet[0]->getPositions(), new Position('B', 8));

        array_push(self::$enemyFleet[1]->getPositions(), new Position('E', 6));
        array_push(self::$enemyFleet[1]->getPositions(), new Position('E', 7));
        array_push(self::$enemyFleet[1]->getPositions(), new Position('E', 8));
        array_push(self::$enemyFleet[1]->getPositions(), new Position('E', 9));

        array_push(self::$enemyFleet[2]->getPositions(), new Position('A', 3));
        array_push(self::$enemyFleet[2]->getPositions(), new Position('B', 3));
        array_push(self::$enemyFleet[2]->getPositions(), new Position('C', 3));

        array_push(self::$enemyFleet[3]->getPositions(), new Position('F', 8));
        array_push(self::$enemyFleet[3]->getPositions(), new Position('G', 8));
        array_push(self::$enemyFleet[3]->getPositions(), new Position('H', 8));

        array_push(self::$enemyFleet[4]->getPositions(), new Position('C', 5));
        array_push(self::$enemyFleet[4]->getPositions(), new Position('C', 6));
    }

    public static function InitializeMyFleetPreset()
    {
        self::$myFleet = GameController::initializeShips();

        // self::$myFleet[0]->addPosition('B4');
        // self::$myFleet[0]->addPosition('B5');
        // self::$myFleet[0]->addPosition('B6');
        // self::$myFleet[0]->addPosition('B7');
        // self::$myFleet[0]->addPosition('B8');

        array_push(self::$myFleet[0]->getPositions(), new Position('B', 4));
        array_push(self::$myFleet[0]->getPositions(), new Position('B', 5));
        array_push(self::$myFleet[0]->getPositions(), new Position('B', 6));
        array_push(self::$myFleet[0]->getPositions(), new Position('B', 7));
        array_push(self::$myFleet[0]->getPositions(), new Position('B', 8));

        // array_push(self::$myFleet[1]->getPositions(), new Position('E', 6));
        // array_push(self::$myFleet[1]->getPositions(), new Position('E', 7));
        // array_push(self::$myFleet[1]->getPositions(), new Position('E', 8));
        // array_push(self::$myFleet[1]->getPositions(), new Position('E', 5));

        // array_push(self::$myFleet[2]->getPositions(), new Position('A', 2));
        // array_push(self::$myFleet[2]->getPositions(), new Position('B', 2));
        // array_push(self::$myFleet[2]->getPositions(), new Position('C', 2));

        // array_push(self::$myFleet[3]->getPositions(), new Position('F', 8));
        // array_push(self::$myFleet[3]->getPositions(), new Position('G', 8));
        // array_push(self::$myFleet[3]->getPositions(), new Position('H', 8));

        // array_push(self::$myFleet[4]->getPositions(), new Position('C', 5));
        // array_push(self::$myFleet[4]->getPositions(), new Position('C', 6));
    }
    private static function printFleetMap($fleet, $type)
    {
        sleep(1);

        self::$console->println("\n  1 2 3 4 5 6 7 8");
        self::$console->println("  ---------------");
        
        for ($i = 0; $i < 8; $i++) {
            $letter = Letter::value($i);
            echo $letter . "|";
            
            for ($j = 1; $j <= 8; $j++) {
                $hasShip = false;
                foreach ($fleet as $ship) {
                    foreach ($ship->getPositions() as $position) {
                        if ($position->getColumn() === $letter && $position->getRow() === $j) {
                            $hasShip = true;
                            break 2;
                        }
                    }
                }
                echo ($hasShip ? "■ " : "· ");
            }
            echo "\n";
        }
        echo "\n";
        file_put_contents($type . 'Fleet.txt', print_r($fleet, true));
    }

    public static function getRandomPosition()
    {
        $rows = 8;
        $lines = 8;

        $letter = Letter::value(random_int(0, $lines - 1));
        $number = random_int(0, $rows - 1);

        return new Position($letter, $number);
    }

    public static function InitializeMyFleet()
    {
        self::$myFleet = GameController::initializeShips();

        self::$console->println("Please position your fleet (Game board has size from A to H and 1 to 8) :");

        foreach (self::$myFleet as $ship) {

            self::$console->println();
            printf("Please enter the positions for the %s (size: %s)", $ship->getName(), $ship->getSize());

            for ($i = 1; $i <= $ship->getSize(); $i++) {
                printf("\nEnter position %s of %s (i.e A3):", $i, $ship->getSize());
                $input = trim(readline(""));
                $ship->addPosition($input);
            }
        }
    }

    public static function beep()
    {
        echo "\007";
    }

    public static function InitializeGame()
    {
        self::InitializeMyFleet();
        // self::InitializeMyFleetPreset();
        
        self::InitializeEnemyFleet();
        
        // self::$console->println("Enemy fleet :");
        // self::printFleetMap(self::$enemyFleet, 'enemy');
        // print_r(self::$enemyFleet);
        
        // self::$console->println("My fleet :");
        // self::printFleetMap(self::$myFleet, 'my');
        // print_r(self::$myFleet);

    // file_put_contents('enemyFleet.txt', print_r(self::$enemyFleet, true));
    // file_put_contents('myFleet.txt', print_r(self::$myFleet, true));
    }

    public static function StartGame()
    {
        self::$console->println("\033[2J\033[;H");
        self::$console->println("                  __");
        self::$console->println("                 /  \\");
        self::$console->println("           .-.  |    |");
        self::$console->println("   *    _.-'  \\  \\__/");
        self::$console->println("    \\.-'       \\");
        self::$console->println("   /          _/");
        self::$console->println("  |      _  /\" \"");
        self::$console->println("  |     /_\'");
        self::$console->println("   \\    \\_/");
        self::$console->println("    \" \"\" \"\" \"\" \"");

        while (true) {

            sleep(1);
            self::$console->println();

            self::$console->println();
            self::$console->setForegroundColor(Color::YELLOW);
            self::$console->println("++++++++++++++++++++++++++++++++++++++++++");

            self::$console->println("Round " . self::$round);

            self::$console->println("++++++++++++++++++++++++++++++++++++++++++");
            self::$console->resetForegroundColor();

            self::$console->println();

            sleep(1);
            self::$console->println("");
            self::$console->setForegroundColor(Color::CHARTREUSE);

            self::$console->println("Player, it's your turn");
            self::$console->println();

        
            // if (self::$lastPosition !== null) {
            //     printf("Last position was %s%s", self::$lastPosition, '');
            // }

            // if (self::$lastIsHit !== null) {
            //     printf("Last shot was %s", self::$lastIsHit ? "hit" : "miss");
            // }
            

            self::$console->println("Enter coordinates for your shot :");
            self::$console->resetForegroundColor();

            self::$console->println();

            $position = readline("");
            self::$console->println();


            $isHit = GameController::checkIsHit(self::$enemyFleet, strtoupper($position));
            if ($isHit) {
                self::beep();
                self::$console->setForegroundColor(Color::RED);
                
                self::$console->println("                \\         .  ./");
                self::$console->println("              \\      .:\" \";'.:..\" \"   /");
                self::$console->println("                  (M^^.^~~:.'\" \").");
                self::$console->println("            -   (/  .    . . \\ \\)  -");
                self::$console->println("               ((| :. ~ ^  :. .|))");
                self::$console->println("            -   (\\- |  \\ /  |  /)  -");
                self::$console->println("                 -\\  \\     /  /-");
                self::$console->println("                   \\  \\   /  /");
                self::$console->println("");
                self::$console->println("Yeah ! Nice hit !");
                self::$console->resetForegroundColor();
            } 
            else {
                self::$console->setForegroundColor(Color::CADET_BLUE);
                self::$console->println("    ~~~~ ~~~~ ~~~~ ~~~~");
                self::$console->println("  ~~~~ ~~~~ ~~~~ ~~~~");
                self::$console->println("~~~~ ~~~~ ~~~~ ~~~~");
                self::$console->println("");
                self::$console->println("Miss");
                self::$console->resetForegroundColor();

            }
            // self::$lastPosition = $position;

            // self::$lastIsHit = $isHit;

            
            sleep(1);
            self::$console->println();
            self::$console->println("It's now the computer's turn.");


            sleep(1);
            self::$console->println();
            self::$console->println("--------------------------------");
            self::$console->println();
            self::$console->setForegroundColor(Color::PURPLE);
            
            $position = self::getRandomPosition();
            $isHit = GameController::checkIsHit(self::$myFleet, $position);
            self::$console->println();
            printf("Computer shoot in %s%s", $position->getColumn(), $position->getRow());
            self::$console->resetForegroundColor();
            self::$console->println();

            if ($isHit) {
                self::beep();
                self::$console->setForegroundColor(Color::RED);

                self::$console->println("                \\         .  ./");
                self::$console->println("              \\      .:\" \";'.:..\" \"   /");
                self::$console->println("                  (M^^.^~~:.'\" \").");
                self::$console->println("            -   (/  .    . . \\ \\)  -");
                self::$console->println("               ((| :. ~ ^  :. .|))");
                self::$console->println("            -   (\\- |  \\ /  |  /)  -");
                self::$console->println("                 -\\  \\     /  /-");
                self::$console->println("                   \\  \\   /  /");
                self::$console->println("Computer hit your ship !");
                
                self::$console->resetForegroundColor();
            } else {
                self::$console->println("");
                self::$console->setForegroundColor(Color::CADET_BLUE);
                self::$console->println("    ~~~~ ~~~~ ~~~~ ~~~~");
                self::$console->println("  ~~~~ ~~~~ ~~~~ ~~~~");
                self::$console->println("~~~~ ~~~~ ~~~~ ~~~~");
                self::$console->println("");
                self::$console->println("Miss");
                self::$console->resetForegroundColor();
            }

            self::$round++;
            sleep(1);

//            exit();
        }
    }

    public static function parsePosition($input)
    {
        if (strlen($input) != 2) {
            throw new Exception("Input should be of length 2");
        }

        $letter = substr($input, 0, 1);
        $number = substr($input, 1, 1);

        if (!ctype_alpha($letter)) {
            throw new Exception("First character should be a letter: $letter");
        }

        Letter::validate($letter);

        if (!is_numeric($number)) {
            throw new Exception("Second character should be a number: $number");
        }

        return new Position($letter, $number);
    }
}