<?php

namespace App\Models\Answers;

use Illuminate\Support\Str;

class Subtraction extends AnswerAbstract
{
    private int $minNum1;
    private int $minNum2;
    private int $maxNum1;
    private int $maxNum2;

    protected function setMinMaxNum1($min, $max): Subtraction
    {
        $this->minNum1 = $min;
        $this->maxNum1 = $max;
        return $this;
    }

    protected function setMinMaxNum2($min, $max): Subtraction
    {
        $this->minNum2 = $min;
        $this->maxNum2 = $max;
        return $this;
    }

    public function get($numItem): array
    {
        $quizzes = [];

        if ($this->difficulty === 'easy') {
            $fixNum1 = [4, 5, 6, 7, 8, 9];
            $fixNum2 = [0, 1, 2, 3, 4, 5, 6, 7];
        } else if ($this->difficulty === 'hard') {
            $fixNum1 = [0, 1, 2, 3, 4, 5, 6, 7];
            $fixNum2 = [3, 4, 5, 6, 7, 8, 9];
        } else {
            $fixNum1 = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
            $fixNum2 = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        }

        for ($i = 0; $i < $numItem; $i++) {
            do {
                $num1 = $this->randomByFixNumbers($this->minNum1, $this->maxNum1, $fixNum1);
            } while ($this->difficulty==='hard' && Str::of($num1)->charAt(0) < 6);
            do {
                $num2 = $this->randomByFixNumbers($this->minNum2, $this->maxNum2, $fixNum2);
            } while ($num2 >= $num1);

            $quizzes[] = (object)[
                'num1' => $num1,
                'num2' => $num2,
                'answer' => number_format($num1 - $num2),
            ];
        }
        return $quizzes;
    }
}
