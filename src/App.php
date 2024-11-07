<?php

use Battleship\GameController;
use Battleship\Position;
use Battleship\Letter;
use Battleship\Color;
use Battleship\ShipPresets;

class App
{
    private static $myFleet = array();
    private static $enemyFleet = array();
    private static $round = 1;
    private static $console;

    private static $myShots = array();
    private static $myHits = array();
    private static $enemyShots = array();
    private static $enemyHits = array();
    private static $shots = array();

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

    public static function InitializeMyFleetPreset()
    {
        self::$myFleet = GameController::initializeShips();

        array_push(self::$myFleet[0]->getPositions(), new Position('B', 4));
        array_push(self::$myFleet[0]->getPositions(), new Position('B', 5));
        array_push(self::$myFleet[0]->getPositions(), new Position('B', 6));
        array_push(self::$myFleet[0]->getPositions(), new Position('B', 7));
        array_push(self::$myFleet[0]->getPositions(), new Position('B', 8));

        array_push(self::$myFleet[1]->getPositions(), new Position('E', 5));
        array_push(self::$myFleet[1]->getPositions(), new Position('E', 6));
        array_push(self::$myFleet[1]->getPositions(), new Position('E', 7));
        array_push(self::$myFleet[1]->getPositions(), new Position('E', 8));

        array_push(self::$myFleet[2]->getPositions(), new Position('A', 3));
        array_push(self::$myFleet[2]->getPositions(), new Position('B', 3));
        array_push(self::$myFleet[2]->getPositions(), new Position('C', 3));

        array_push(self::$myFleet[3]->getPositions(), new Position('F', 8));
        array_push(self::$myFleet[3]->getPositions(), new Position('G', 8));
        array_push(self::$myFleet[3]->getPositions(), new Position('H', 8));

        array_push(self::$myFleet[4]->getPositions(), new Position('C', 5));
        array_push(self::$myFleet[4]->getPositions(), new Position('C', 6));
    }

    public static function InitializeEnemyFleet($presetNumber = 1)
    {
        self::$enemyFleet = GameController::initializeShips();
        
        $positions = match($presetNumber) {
            1 => ShipPresets::getPreset1(),
            2 => ShipPresets::getPreset2(),
            3 => ShipPresets::getPreset3(),
            4 => ShipPresets::getPreset4(),
            5 => ShipPresets::getPreset5(),
            6 => ShipPresets::getPreset6(),
            7 => ShipPresets::getPreset7(),
            default => ShipPresets::getPreset1(),
        };
        
        for ($i = 0; $i < count(self::$myFleet); $i++) {
            foreach ($positions[$i] as $position) {
                array_push(self::$enemyFleet[$i]->getPositions(), $position);
            }
        }
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
        $number = random_int(1, $rows);

        return new Position($letter, $number);
    }

    public static function InitializeMyFleet()
    {
        self::$myFleet = GameController::initializeShips();

        self::$console->println("Please position your fleet (Game board has size from A to H and 1 to 8) :");

        foreach (self::$myFleet as $ship) {

            self::$console->println();
            self::$console->println("--------------------------------");
            self::$console->println();
            printf("Please enter the positions for the %s (size: %s)", $ship->getName(), $ship->getSize());
            self::$console->println();

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
        // self::InitializeMyFleet();
        self::InitializeMyFleetPreset();

        $presetNumber = random_int(1, 7);

        // self::$console->println("Enemy preset number: " . $presetNumber);

        self::InitializeEnemyFleet($presetNumber);
        // self::printFleetMap(self::$enemyFleet, 'enemy');

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

        while (self::$round <= 64) {

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

            if (count(self::$myShots) > 0) {
                self::$console->println(sprintf("Last shot was on position %s and it was a %s", self::$myShots[count(self::$myShots) - 1], self::$myHits[count(self::$myHits) - 1] ? "hit" : "miss"));
                self::$console->println();
                self::$console->println();
            }

            self::$console->println("Sunked your ships: " . implode(", ", self::getSunkedShips(self::$myFleet)));
            self::$console->println();
            self::$console->println("Sunked enemy ships: " . implode(", ", self::getSunkedShips(self::$enemyFleet)));
            self::$console->println();

            self::$console->println("Enter coordinates for your shot :");
            self::$console->resetForegroundColor();

            self::$console->println();

            $position = trim(readline(""));

            try {
                $position = Position::fromString($position);
            } catch (Exception $e) {
                self::$console->setForegroundColor(Color::RED);
                print 'Position is invalid, please try again';
                continue;
            }

            self::$console->println();

            $position = self::isMultipleHit($position);
            array_push(self::$shots, $position);

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

            array_push(self::$myShots, strtoupper($position));
            array_push(self::$myHits, $isHit);


            sleep(1);
            self::$console->println();
            self::$console->println("It's now the computer's turn.");

            if (count(self::$enemyShots) > 0) {
                self::$console->println(sprintf("Last shot was on position %s and it was a %s", self::$enemyShots[count(self::$enemyShots) - 1], self::$enemyHits[count(self::$enemyHits) - 1] ? "hit" : "miss"));
                self::$console->println();
                self::$console->println();
            }

            // sleep(1);
            self::$console->println();
            
            self::$console->println("Enemy Shots:");
            foreach (self::$enemyShots as $shot) {
                self::$console->println($shot);
            }
            self::$console->println();

            sleep(1);
            self::$console->println();
            self::$console->println("--------------------------------");
            self::$console->println();
            self::$console->setForegroundColor(Color::PURPLE);

            $position = self::getRandomPosition();

            while (in_array($position, self::$enemyShots)) {
                $position = self::getRandomPosition();
            }

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

            array_push(self::$enemyShots, $position);
            array_push(self::$enemyHits, $isHit);

            self::$round++;
            sleep(1);

//            exit();
        }

    self::$console->setForegroundColor(Color::GREEN);
    self::$console->println(" __     ______  _    _   __          _______ _   _ ");
    self::$console->println(" \\ \\   / / __ \\| |  | |  \\ \\        / /_   _| \\ | |");
    self::$console->println("  \\ \\_/ / |  | | |  | |   \\ \\  /\\  / /  | | |  \\| |");
    self::$console->println("   \\   /| |  | | |  | |    \\ \\/  \\/ /   | | | . ` |");
    self::$console->println("    | | | |__| | |__| |     \\  /\\  /   _| |_| |\\  |");
    self::$console->println("    |_|  \\____/ \\____/       \\/  \\/   |_____|_| \\_|");
    self::$console->resetForegroundColor();
    self::$console->println("You won, try again!");
        
    self::$console->setForegroundColor(Color::YELLOW);
    self::$console->println("  _____                         ____                 _ ");
    self::$console->println(" / ____|                       / __ \\               | |");
    self::$console->println("| |  __  __ _ _ __ ___   ___  | |  | |_   _____ _ __| |");
    self::$console->println("| | |_ |/ _` | '_ ` _ \\ / _ \\ | |  | \\ \\ / / _ \\ '__| |");
    self::$console->println("| |__| | (_| | | | | | |  __/ | |__| |\\ V /  __/ |  |_|");
    self::$console->println(" \\_____|\\__,_|_| |_| |_|\\___|  \\____/  \\_/ \\___|_|  (_)");
    self::$console->resetForegroundColor();



    }

    private static function isMultipleHit($position) {
        foreach (self::$shots as $shot) {
            if ($position == $shot) {
                self::$console->println("Duplicate shot! Enter coordinates for your shot again:");
                self::$console->resetForegroundColor();
    
                self::$console->println();
    
                $position = readline("");
                self::$console->println();
                $position = self::isMultipleHit($position);
    
            }
        }
        return $position;
    }

    private static function getSunkedShips($fleet) {
        $sunkedShips = [];
        foreach ($fleet as $ship) {
            if ($ship->isSunk()) {
                $sunkedShips[] = $ship->getName();
            } 
        }
        return $sunkedShips;
    }

    private static function isEndOfGame() {
        $myFleet = self::$myFleet;
        $enemyFleet = self::$enemyFleet;
                                                                     
        foreach ($myFleet as $key => $ship) {
            if ($ship->isSunk()) {
                unset($myFleet[$key]);
            } 
        }

        foreach ($enemyFleet as $key => $ship) {
            if ($ship->isSunk()) {
                unset($enemyFleet[$key]);
            } 
        }
        
        return empty($myFleet) or empty($enemyFleet);
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
