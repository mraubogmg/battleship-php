<?php

namespace Battleship;

use InvalidArgumentException;

class Position
{
    /**
     * @var string
     */
    private $column;
    private $row;

    /**
     * Position constructor.
     * @param string $letter
     * @param string $number
     */
    public function __construct($letter, $number)
    {
        $this->column = Letter::validate(strtoupper($letter));
        $this->row = Row::validate($number);
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function __toString()
    {
        return sprintf("%s%s", $this->column, $this->row);
    }

    public static function fromString($position)
    {
        $position = str_split($position);

        if (count($position) != 2) {
            throw new InvalidArgumentException('Invalid position');
        }

        list($letter, $number) = $position;

        return new self($letter, $number);
    }
}
