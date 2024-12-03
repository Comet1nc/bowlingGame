<?php

declare(strict_types=1);

namespace BowlingGame\Frames;

use BowlingGame\Counters\ScoreCounterDefault;

class TenthFrame extends Frame
{
  protected int $availableRolls = 1;

  public function __construct()
  {
    $this->counter = new ScoreCounterDefault();

    $this->rollsHandlers = [
      0 => function ($pins) {
        if ($this->isStrike($pins)) {
          $this->availableRolls++;
        }
      },
      1 => function () {
        if ($this->hasSpare()) {
          $this->availableRolls++;
        }
      },
      2 => function () {}
    ];
  }

  public function getPinsSum()
  {
    return $this->pins[0] + $this->pins[1] + $this->pins[2];
  }

  public function roll($pins)
  {
    $this->pins[$this->currentRollIndex] = $pins;
    $this->rollsHandlers[$this->currentRollIndex]($pins);
    $this->availableRolls--;
    $this->currentRollIndex++;
  }
}