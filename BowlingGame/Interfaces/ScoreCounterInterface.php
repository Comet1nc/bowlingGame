<?php

namespace BowlingGame\Interfaces;

interface ScoreCounterInterface
{
  public function countScore($targetFrameIndex, $frames);
}