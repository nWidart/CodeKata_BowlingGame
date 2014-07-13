<?php

namespace spec;

use Game;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Game');
    }
    /**
     * can roll
     */
    function it_can_roll()
    {
        $this->roll(0);
    }

    /**
     * can roll gutter game
     */
    function it_can_roll_gutter_game()
    {
        $this->rollMany(20, 0);
        $this->score()->shouldReturn(0);
    }

    /**
     * can roll all ones
     */
    function it_can_roll_all_ones()
    {
        $this->rollMany(20, 1);
        $this->score()->shouldReturn(20);
    }

    /**
     * can roll spare
     */
    function it_can_roll_one_spare()
    {
        $this->rollSpare();
        $this->roll(3);
        $this->rollMany(17, 0);
        $this->score()->shouldReturn(16);
    }

    /**
     * can roll strike
     */
    function it_can_roll_strike()
    {
        $this->rollStrike();
        $this->roll(3);
        $this->roll(4);
        $this->rollMany(16, 0);
        $this->score()->shouldReturn(24);
    }

    /**
     * can roll a perfect game
     */
    function it_can_roll_a_perfect_game()
    {
        $this->rollMany(12,10);
        $this->score()->shouldReturn(300);
    }

    /**
     * counts two bonus rolls for strike
     */
    function it_counts_two_bonus_rolls_for_strike()
    {
        $this->rollStrike();  // 10 + 10 + 5 = 25
        $this->rollStrike();  // 10 + 5 + 2  = 17
        $this->roll(5); // + 5
        $this->roll(2); // + 2
        $this->rollMany(14, 0);
        $this->score()->shouldReturn(49);
    }

    /**
     * @param $n
     * @param $pins
     */
    public function rollMany($n, $pins)
    {
        for ($i = 0; $i < $n; $i++) {
            $this->roll($pins);
        }
    }

    public function rollSpare()
    {
        $this->roll(5);
        $this->roll(5);
    }

    public function rollStrike()
    {
        $this->roll(10);
    }
}
