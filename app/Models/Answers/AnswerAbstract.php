<?php
namespace App\Models\Answers;
use App\Traits\Randoms;

abstract class AnswerAbstract{
    use Randoms;
    protected int $minDigits = 2;
    protected int $maxDigits = 2;
    protected string $difficulty = 'normal';
    protected string $level = 'p1-3';

    public function setDifficulty(string $difficulty): AnswerAbstract
    {
        $this->difficulty = $difficulty;
        return $this;
    }

    public function setLevel(string $level): AnswerAbstract
    {
        $this->level = $level;
        return $this;
    }
    
    abstract public function get(int $numItem);
}