<?php


use Battleship\Position;
use PHPUnit\Framework\TestCase;


class AppTests extends TestCase
{

    public function testParsePosition()
    {
        $actual = App::parsePosition("A1");
        $expected = new Position('A', 1);
        $this->assertEquals($expected, $actual);
    }

    public function testParsePosition2()
    {
        //given
        $expected = new Position('B', 1);
        //when
        $actual = App::parsePosition("B1");
        //then
        $this->assertEquals($expected, $actual);
    }

    public function testInitializeEnemyFleet()
    {
        // Test with preset 1
        App::InitializeEnemyFleet(1);
        
        // Get the enemy fleet using reflection since it's a private static property
        $reflectionClass = new ReflectionClass('App');
        $enemyFleetProperty = $reflectionClass->getProperty('enemyFleet');
        $enemyFleetProperty->setAccessible(true);
        $enemyFleet = $enemyFleetProperty->getValue();
        
        // Assert that we have 5 ships (as per game rules)
        $this->assertCount(5, $enemyFleet);
        
        // Verify each ship has the correct number of positions
        $expectedSizes = [5, 4, 3, 3, 2]; // Standard Battleship ship sizes
        foreach ($enemyFleet as $index => $ship) {
            $this->assertCount($expectedSizes[$index], $ship->getPositions());
        }
    }

}