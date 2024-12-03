<?php

declare(strict_types=1);

namespace BowlingGame\Counters;

use BowlingGame\Interfaces\ScoreCounterInterface;

class ScoreCounterAfterStrike implements ScoreCounterInterface
{
  public function countScore($targetFrameIndex, $allFrames)
  {
    $currentFrame = $allFrames[$targetFrameIndex];
    $nextFrame = $allFrames[$targetFrameIndex + 1];
    $nextFrameSum = $nextFrame->getFirstTwoRollsPinsSum();

    if ($nextFrame->hasStrike()) {
      $thirdFrameSum = 0;
      if ($targetFrameIndex < 8) {
        $thirdFrame = $allFrames[$targetFrameIndex + 2];
        $thirdFrameSum = $thirdFrame->getFirstRollPins();
      }

      return $currentFrame->getFirstTwoRollsPinsSum() + $nextFrameSum + $thirdFrameSum;
    } else {

      return $currentFrame->getFirstTwoRollsPinsSum() + $nextFrame->getFirstRollPins();
    }
  }
}
