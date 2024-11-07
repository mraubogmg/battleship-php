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
} 