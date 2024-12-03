<?php

declare(strict_types=1);

namespace BowlingGame;

class DisplayGameResults
{
  public static function showEndGameMessage($frames): void
  {
    echo "----------------------------------\n";
    echo "Congratulations! Game is finished!\n";
    DisplayGameResults::showResultsTable($frames);
  }

  public static function showResultsTable($frames)
  {
    $totalScore = 0;

    echo "SCORE TABLE: \n";

    for ($i = 0; $i < count($frames); $i++) {
      $frameScore = $frames[$i]->counter->countScore($i, $frames);
      $totalScore += $frameScore;

      echo "Frame: " . ($i + 1) . " / Frame score: " . $frameScore . " / Total score: " . $totalScore . "\n";
    }

    return $totalScore;
  }
}