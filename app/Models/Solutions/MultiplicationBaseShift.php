<?php

namespace App\Models\Solutions;

use App\Traits\Randoms;
use stdClass;

class MultiplicationBaseShift extends SolutionAbstract
{
    use Randoms;

    protected int $minNum1Digits;
    protected int $minNum2Digits;
    protected int $maxNum1Digits;
    protected int $maxNum2Digits;

    public function __construct($level, $difficulty)
    {
        $this->level = $level;
        $this->difficulty = $difficulty;
    }

    protected function getQuiz(): stdClass
    {
        $levelBases = [
            'p4-6' => [10, 100, 1000],
            'm1-3'  => [100, 1000, 10000, 10000, 100000],
        ];

        $bases = $levelBases[$this->level] ?? [10, 100];
        $collection = collect($bases);
        $base = $collection->random();

        if ($this->difficulty === 'easy') {
            $limit10 = 9;
            $limit100 = 49;
            $limit1K = 99;
            $limit10K = 99;
            $limit100K = 199;
        } elseif ($this->difficulty === 'hard') {
            $limit10 = 9;
            $limit100 = 99;
            $limit1K = 999;
            $limit10K = 9999;
            $limit100K = 999;
        } else {
            $limit10 = 9;
            $limit100 = 69;
            $limit1K = 129;
            $limit10K = 129;
            $limit100K = 299;
        }


        $limits = [
            10 => $limit10,
            100 => $limit100,
            1000 => $limit1K,
            10000 => $limit10K,
            100000 => $limit100K
        ];

        if ($base === $collection->min()) {
            $num1 = $base + mt_rand(1, $limits[$base]);
            $num2 = $base + mt_rand(1, $limits[$base]);
        } else if ($base === $collection->max()) {
            $num1 = $base - mt_rand(1, $limits[$base]);
            $num2 = $base - mt_rand(1, $limits[$base]);
        } else {

            $num1 = $base + mt_rand(1, $limits[$base]) * (mt_rand(0, 1) ? -1 : 1);
            $num2 = $base + mt_rand(1, $limits[$base]) * (mt_rand(0, 1) ? -1 : 1);
        }


        return (object)[
            'num1' => $num1,
            'num2' => $num2,
        ];
    }


    public function get(int $numItems): array
    {

        $quizzes = [];
        for ($i = 0; $i < $numItems; $i++) {
            $quizzes[] = $this->getQuiz();
        }
        // return array_map(fn ($x) => $operations[$this->difficulty], range(1, $numItems));
        return $quizzes;
    }
}

