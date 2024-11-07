<?php


namespace Battleship;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


final class PositionTests extends TestCase
{
    public function testConstructorShouldRaiseExceptionsWhenLetterIsŔOutOfRange()
    {
        $this->expectException(InvalidArgumentException::class);

        new Position('Z', '1');
    }

    public function testConstructorShouldRaiseExceptionsWhenNumberIsOutOfRange()
    {
        $this->expectException(InvalidArgumentException::class);

        new Position('A', '100');
    }

    public function testfromStringShouldThrowErrorWhenCannotParsePosition()
    {
        $this->expectException(InvalidArgumentException::class);

        Position::fromString('Z');
    }

    public function testfromStringShouldReturnNewPositionWhenParseSucceeded()
    {
        $position = Position::fromString('A1');

        $this->assertEquals('A', $position->getColumn());
        $this->assertEquals('1', $position->getRow());
    }
}