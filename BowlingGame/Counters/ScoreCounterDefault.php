<?php

declare(strict_types=1);

namespace BowlingGame\Counters;

use BowlingGame\Interfaces\ScoreCounterInterface;

class ScoreCounterDefault implements ScoreCounterInterface
{
    public function countScore($targetFrameIndex, $allFrames)
    {
        return $allFrames[$targetFrameIndex]->getPinsSum();
    }
}



