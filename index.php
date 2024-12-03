<?php

declare(strict_types=1);

use BowlingGame\DisplayGameResults;
use BowlingGame\Game;

spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});

$game = new Game();

while (!$game->isCompleted()) {
  // $pins = readline('Enter number of pins: ');
  $pins = 10;
  $game->roll($pins);
}
echo DisplayGameResults::showEndGameMessage($game->frames);