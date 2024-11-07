<?php

namespace Battleship;

use InvalidArgumentException;

class Row
{
    public static function validate($row) : string
    {
        $row = (int) $row;

        if (!in_array($row, range(1, 8))) {
            throw new InvalidArgumentException('row is invalid');
        }

        return $row;
    }
}
