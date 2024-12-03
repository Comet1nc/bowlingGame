<?php

declare(strict_types=1);

namespace BowlingGame\Counters;

use BowlingGame\Interfaces\ScoreCounterInterface;

class ScoreCounterAfterSpare implements ScoreCounterInterface
{
  public function countScore($targetFrameIndex, $allFrames)
  {
    $currentFrame = $allFrames[$targetFrameIndex];
    return $currentFrame->getFirstTwoRollsPinsSum() +
      $allFrames[$targetFrameIndex + 1]->getFirstRollPins();
  }
}