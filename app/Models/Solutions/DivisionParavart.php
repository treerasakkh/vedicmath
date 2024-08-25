<?php

namespace App\Models\Solutions;

use App\Traits\Randoms;
use stdClass;
use App\View\Components\Solutions\DivisionParavart as Paravart;

class DivisionParavart extends SolutionAbstract
{
    use Randoms;

    protected string $level;
    protected string $difficulty;
    protected int $minDividendDigits;
    protected int $maxDividendDigits;
    protected int $minDivisorDigits;
    protected int $maxDivisorDigits;

    public function __construct(string $level, string $difficulty)
    {
        $this->level = $level;
        $this->difficulty = $difficulty;
    }


    protected function defineNumberRange(): void

    {
        $levelRanges = [
            'm1-3' => [4, 6, 2, 4],
            'default' => [3, 3, 2, 2]
        ];

        [$minDividend, $maxDividend, $minDivisor, $maxDivisor] = $levelRanges[$this->level] ?? $levelRanges['default'];
        $this->setMinMaxDividend($minDividend, $maxDividend);
        $this->setMinMaxDivisor($minDivisor, $maxDivisor);
    }

    protected function setMinMaxDividend(int $min, int $max): void
    {
        $this->minDividendDigits = $min;
        $this->maxDividendDigits = $max;
    }

    protected function setMinMaxDivisor(int $min, int $max): void
    {
        $this->minDivisorDigits = $min;
        $this->maxDivisorDigits = $max;
    }

    protected function getDifficultySettings(): array
    {
        $difficultyMap = [
            'easy' => [
                'fixDividendDigits' => [0, 1, 2, 3, 4, 5, 6],
                'fixDivisorDigits' => [0, 1, 2, 3, 4, 5, 6]
            ],
            'hard' => [
                'fixDividendDigits' => [4, 5, 6, 7, 8, 9],
                'fixDivisorDigits' => [4, 5, 6, 7, 8, 9]
            ],
            'default' => [
                'fixDividendDigits' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                'fixDivisorDigits' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
            ]
        ];

        return $difficultyMap[$this->difficulty] ?? $difficultyMap['default'];
    }


    protected function generateQuiz(): stdClass
    {
        do {
            [$dividend, $divisor] = $this->level === 'm1-3' ? $this->generateForM13() : $this->generateForOther();

            $paravart = new Paravart($dividend, $divisor, 0, false, false);
        } while ($paravart->isMore);

        $answer = (object)[
            'product' => intdiv($dividend, $divisor),
            'remaider' => $dividend % $divisor
        ];
        return (object)['dividend' => $dividend, 'divisor' => $divisor, 'answer' => $answer];
    }

    protected function generateForM13(): array
    {
        $divisor = $this->getDivisor([1, 1, 1, 2, 2, 2, 3, 3, 3, 4, 4, 4, 5, 5, 5]);
        $length = mt_rand(4, 6);

        if ($this->difficulty === 'easy') {
            $fixNumbers = [0, 1, 2, 3, 4, 5];
        } else if ($this->difficulty === 'hard') {
            $fixNumbers = [ 4, 5, 6, 7, 8, 9];
        } else {

            $fixNumbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        }

        $dividend = $this->generateRandomNumber($length, $fixNumbers);
        return [$dividend, $divisor];
    }

    protected function getDivisor(array $numbers): int
    {
        $numSet = collect($numbers);
        $randomNumbers = $numSet->shuffle()->take(mt_rand(1, 3));
        return intval(implode(array_merge([1], $randomNumbers->toArray())));
    }

    protected function generateForOther(): array
    {
        $divisor = mt_rand(11, 15);
        $maxMultiplier = intdiv(999, $divisor);
        $minMultiplier = intdiv(100, $divisor) + 1;

        do {
            $multiplier = mt_rand($minMultiplier, $maxMultiplier);
            $invalid = $this->findGCD($multiplier, $divisor) === 1;
        } while ($invalid);

        $dividend = $multiplier * $divisor;

        return [$dividend, $divisor];
    }

    protected function findGCD($a, $b)
    {
        return $b == 0 ? $a : $this->findGCD($b, $a % $b);
    }

    public function get(int $numItems): array
    {
        $this->defineNumberRange();
        return array_map(fn () => $this->generateQuiz(), range(1, $numItems));
    }
}
