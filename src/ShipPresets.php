<?php

namespace Battleship;

use Battleship\Position;

class ShipPresets
{
    public static function getPreset1()
    {
        return [
            // Carrier (5 spaces)
            [
                new Position('A', 1),
                new Position('A', 2),
                new Position('A', 3),
                new Position('A', 4),
                new Position('A', 5),
            ],
            // Battleship (4 spaces)
            [
                new Position('C', 3),
                new Position('C', 4),
                new Position('C', 5),
                new Position('C', 6),
            ],
            // Cruiser (3 spaces)
            [
                new Position('E', 1),
                new Position('E', 2),
                new Position('E', 3),
            ],
            // Submarine (3 spaces)
            [
                new Position('G', 5),
                new Position('G', 6),
                new Position('G', 7),
            ],
            // Destroyer (2 spaces)
            [
                new Position('D', 8),
                new Position('E', 8),
            ],
        ];
    }

    public static function getPreset2()
    {
        return [
            // Carrier (5 spaces)
            [
                new Position('D', 1),
                new Position('D', 2),
                new Position('D', 3),
                new Position('D', 4),
                new Position('D', 5),
            ],
            // Battleship (4 spaces)
            [
                new Position('A', 1),
                new Position('B', 1),
                new Position('C', 1),
                new Position('D', 1),
            ],
            // Cruiser (3 spaces)
            [
                new Position('F', 3),
                new Position('F', 4),
                new Position('F', 5),
            ],
            // Submarine (3 spaces)
            [
                new Position('H', 6),
                new Position('H', 7),
                new Position('H', 8),
            ],
            // Destroyer (2 spaces)
            [
                new Position('B', 7),
                new Position('B', 8),
            ],
        ];
    }

    public static function getPreset3()
    {
        return [
            // Carrier (5 spaces)
            [
                new Position('A', 4),
                new Position('B', 4),
                new Position('C', 4),
                new Position('D', 4),
                new Position('E', 4),
            ],
            // Battleship (4 spaces)
            [
                new Position('C', 5),
                new Position('C', 6),
                new Position('C', 7),
                new Position('C', 8),
            ],
            // Cruiser (3 spaces)
            [
                new Position('F', 1),
                new Position('F', 2),
                new Position('F', 3),
            ],
            // Submarine (3 spaces)
            [
                new Position('H', 1),
                new Position('H', 2),
                new Position('H', 3),
            ],
            // Destroyer (2 spaces)
            [
                new Position('A', 7),
                new Position('A', 8),
            ],
        ];
    }

    public static function getPreset4()
    {
        return [
            // Carrier (5 spaces) - Horizontal top
            [
                new Position('A', 1),
                new Position('A', 2),
                new Position('A', 3),
                new Position('A', 4),
                new Position('A', 5),
            ],
            // Battleship (4 spaces) - Vertical right
            [
                new Position('E', 8),
                new Position('F', 8),
                new Position('G', 8),
                new Position('H', 8),
            ],
            // Cruiser (3 spaces) - Horizontal middle
            [
                new Position('D', 1),
                new Position('D', 2),
                new Position('D', 3),
            ],
            // Submarine (3 spaces) - Horizontal near bottom
            [
                new Position('G', 3),
                new Position('G', 4),
                new Position('G', 5),
            ],
            // Destroyer (2 spaces) - Vertical near center
            [
                new Position('C', 5),
                new Position('D', 5),
            ],
        ];
    }

    public static function getPreset5()
    {
        return [
            // Carrier (5 spaces) - Vertical left
            [
                new Position('A', 1),
                new Position('B', 1),
                new Position('C', 1),
                new Position('D', 1),
                new Position('E', 1),
            ],
            // Battleship (4 spaces) - Horizontal middle
            [
                new Position('D', 4),
                new Position('D', 5),
                new Position('D', 6),
                new Position('D', 7),
            ],
            // Cruiser (3 spaces) - Vertical right
            [
                new Position('B', 8),
                new Position('C', 8),
                new Position('D', 8),
            ],
            // Submarine (3 spaces) - Horizontal bottom
            [
                new Position('H', 4),
                new Position('H', 5),
                new Position('H', 6),
            ],
            // Destroyer (2 spaces) - Vertical mid-left
            [
                new Position('F', 2),
                new Position('G', 2),
            ],
        ];
    }

    public static function getPreset6()
    {
        return [
            // Carrier (5 spaces) - Horizontal middle
            [
                new Position('D', 2),
                new Position('D', 3),
                new Position('D', 4),
                new Position('D', 5),
                new Position('D', 6),
            ],
            // Battleship (4 spaces) - Vertical left
            [
                new Position('A', 2),
                new Position('B', 2),
                new Position('C', 2),
                new Position('D', 2),
            ],
            // Cruiser (3 spaces) - Horizontal top
            [
                new Position('B', 5),
                new Position('B', 6),
                new Position('B', 7),
            ],
            // Submarine (3 spaces) - Vertical right
            [
                new Position('F', 8),
                new Position('G', 8),
                new Position('H', 8),
            ],
            // Destroyer (2 spaces) - Horizontal bottom
            [
                new Position('G', 3),
                new Position('G', 4),
            ],
        ];
    }

    public static function getPreset7()
    {
        return [
            // Carrier (5 spaces) - Vertical center
            [
                new Position('B', 4),
                new Position('C', 4),
                new Position('D', 4),
                new Position('E', 4),
                new Position('F', 4),
            ],
            // Battleship (4 spaces) - Horizontal top
            [
                new Position('A', 1),
                new Position('A', 2),
                new Position('A', 3),
                new Position('A', 4),
            ],
            // Cruiser (3 spaces) - Horizontal bottom
            [
                new Position('H', 5),
                new Position('H', 6),
                new Position('H', 7),
            ],
            // Submarine (3 spaces) - Vertical right
            [
                new Position('C', 7),
                new Position('D', 7),
                new Position('E', 7),
            ],
            // Destroyer (2 spaces) - Horizontal middle
            [
                new Position('F', 1),
                new Position('F', 2),
            ],
        ];
    }
} 