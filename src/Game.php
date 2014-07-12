<?php

class Game
{
    private $rolls = [];
    private $currentRoll = 0;

    public function roll($pins)
    {
        $this->rolls[$this->currentRoll++] = $pins;
    }

    public function score()
    {
        $score = 0;
        $firstInFrame = 0;
        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isStrike($firstInFrame)) {
                $score += 10 + $this->strikeBonus($firstInFrame);
                $firstInFrame++;
            } else if ($this->isSpare($firstInFrame)) {
                $score += 10 + $this->spareBonus($firstInFrame);
                $firstInFrame += 2;
            } else {
                $score += $this->sumOfFrames($firstInFrame);
                $firstInFrame += 2;
            }
        }

        return $score;
    }

    /**
     * @param $firstInFrame
     * @return bool
     */
    public function isSpare($firstInFrame)
    {
        return $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1] == 10;
    }

    /**
     * @param $firstInFrame
     * @return bool
     */
    public function isStrike($firstInFrame)
    {
        return $this->rolls[$firstInFrame] == 10;
    }

    private function strikeBonus($firstInFrame)
    {
        return $this->rolls[$firstInFrame + 1] + $this->rolls[$firstInFrame + 2];
    }

    /**
     * @param $firstInFrame
     * @return mixed
     */
    public function sumOfFrames($firstInFrame)
    {
        return $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1];
    }

    /**
     * @param $firstInFrame
     * @return mixed
     */
    public function spareBonus($firstInFrame)
    {
        return $this->rolls[$firstInFrame + 2];
    }
}
