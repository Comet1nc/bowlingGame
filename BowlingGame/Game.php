<?php

declare(strict_types=1);

namespace BowlingGame;

use BowlingGame\Frames\Frame;
use BowlingGame\Frames\TenthFrame;

class Game
{
  /** @var Frame[] $rolls */
  public array $frames = [];
  private int $totalScore = 0;
  private int $currentFrameIndex = 0;
  private bool $isCompleted = false;

  public function __construct()
  {
    for ($i = 0; $i < 9; $i++) {
      $this->frames[] = new Frame();
    }
    $this->frames[] = new TenthFrame();
  }

  public function isCompleted(): bool
  {
    return $this->isCompleted;
  }

  public function roll($pins)
  {
    $currentFrame = $this->frames[$this->currentFrameIndex];
    $currentFrame->roll($pins);

    // $frameScore = $currentFrame->counter->countScore($this->currentFrameIndex, $this->frames);

    $this->totalScore = $this->countTotalScore($this->currentFrameIndex);

    // $this->displayScoreAfterRoll($frameScore); DELETE IT !!!

    if (!$currentFrame->hasAvailableRolls()) {
      if ($currentFrame instanceof TenthFrame) {
        $this->isCompleted = true;
      }
      $this->currentFrameIndex++;
    }
  }

  private function countTotalScore($maxFrameIndex): int
  {
    $totalScore = 0;
    for ($i = 0; $i < $maxFrameIndex; $i++) {
      $frameScore = $this->frames[$i]->counter->countScore($i, $this->frames);
      $totalScore += $frameScore;
    }
    return $totalScore;
  }

  private function displayScoreAfterRoll(int $frameScore): void
  {
    echo "Frame " . ($this->currentFrameIndex + 1) . "/10 | Frame Score: $frameScore | Total Score: " . ($this->totalScore + $frameScore) . "\n";
  }
}