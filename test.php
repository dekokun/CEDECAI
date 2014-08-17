<?php

class AllTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function Turnがいい感じに動く()
    {
        $turn = new Turn(1, Turn::WEEKDAY);
        $this->assertEquals(1, $turn->getNextTurn());
    }

    /**
     * @test
     */
    public function getRemainTurnがいい感じに動く()
    {
        $turn = new Turn(1, Turn::WEEKDAY);
        $this->assertEquals(['W' => 5, 'H' => 5], $turn->getRemainTurns());
        $turn = new Turn(2, Turn::HOLIDAY);
        $this->assertEquals(['W' => 4, 'H' => 5], $turn->getRemainTurns());
        $turn = new Turn(10, Turn::HOLIDAY);
        $this->assertEquals(['W' => 0, 'H' => 1], $turn->getRemainTurns());
    }
}
