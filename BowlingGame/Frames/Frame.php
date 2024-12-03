<?php

declare(strict_types=1);

namespace BowlingGame\Frames;

use BowlingGame\Counters\ScoreCounterDefault;
use BowlingGame\Counters\ScoreCounterAfterSpare;
use BowlingGame\Counters\ScoreCounterAfterStrike;
use BowlingGame\Interfaces\ScoreCounterInterface;

class Frame
{
  /** @var int[] $pins */
  protected array $pins = [0, 0, 0];
  public ScoreCounterInterface $counter;
  protected int $currentRollIndex = 0;
  protected int $availableRolls = 1;
  /** @var callable[] $rollsHandlers */
  protected array $rollsHandlers;

  public function __construct()
  {
    $this->counter = new ScoreCounterDefault();

    $this->rollsHandlers = [
      0 => function ($pins) {
        if ($this->isStrike($pins)) {
          $this->counter = new ScoreCounterAfterStrike();
          $this->availableRolls = 0;
        }
      },
      1 => function () {
        if ($this->hasSpare()) {
          $this->counter = new ScoreCounterAfterSpare();
        }
        $this->availableRolls = 0;
      }
    ];
  }

  public static function isStrike($pins)
  {
    return $pins === 10;
  }

  public function hasStrike()
  {
    return $this->pins[0] === 10 || $this->pins[1] === 10;
  }

  public function hasSpare()
  {
    return $this->pins[0] + $this->pins[1] > 9;
  }

  public function getFirstTwoRollsPinsSum()
  {
    return $this->pins[0] + $this->pins[1];
  }

  public function getFirstRollPins()
  {
    return $this->pins[0];
  }

  public function getPinsSum()
  {
    return $this->getFirstTwoRollsPinsSum();
  }

  public function roll($pins)
  {
    $this->pins[$this->currentRollIndex] = $pins;
    $this->rollsHandlers[$this->currentRollIndex]($pins);
    $this->currentRollIndex++;
  }

  public function hasAvailableRolls()
  {
    return $this->availableRolls > 0;
  }
}