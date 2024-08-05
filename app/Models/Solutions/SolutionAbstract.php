<?php

namespace App\Models\Solutions;

use App\Traits\Randoms;

abstract class SolutionAbstract
{
    use Randoms;
    protected int $minDigitNum1 = 2;
    protected int $maxDigitNum1 = 2;
    protected int $minDigitNum2 = 2;
    protected int $maxDigitNum2 = 2;
    protected string $difficulty = 'normal';
    protected string $level = 'p1-3';

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;
        return $this;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;
        return $this;
    }

    abstract public function get(int $numItem);
}
