<?php

namespace App\Models\Answers;

class Division extends AnswerAbstract
{
    private int $minNum1;
    private int $minNum2;
    private int $maxNum1;
    private int $maxNum2;
    private bool $hasRemainder = false;

    protected function setMinMaxNum1($min, $max): Division
    {
        $this->minNum1 = $min;
        $this->maxNum1 = $max;
        return $this;
    }

    protected function setMinMaxNum2($min, $max): Division
    {
        $this->minNum2 = $min;
        $this->maxNum2 = $max;
        return $this;
    }
    protected function setHasRemainder(bool $value): Division
    {
        $this->hasRemainder = $value;
        return $this;
    }
    public function get($numItem): array
    {
        $quizzes = [];

        if ($this->difficulty === 'easy') {
            $fixNum1 = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
            $fixNum2 = [0, 1, 2, 3, 4, 5];
        } else if ($this->difficulty === 'hard') {
            $fixNum1 = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
            $fixNum2 = [4, 5, 6, 7, 8, 9];
        } else {
            $fixNum1 = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
            $fixNum2 = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        }

        for ($i = 0; $i < $numItem; $i++) {

            $num1 = $this->randomByFixNumbers($this->minNum1, $this->maxNum1, $fixNum1);
            do {
                $num2 = $this->randomByFixNumbers($this->minNum2, $this->maxNum2, $fixNum2);
            } while ($num2 < 3 || $num2 > $num1 );

            if ($num1 === $num2) {
                $i--;
                continue;
            }

            $product = floor($num1 / $num2);

            if($product<1){
                $i--;
                continue;
            }
            
            $remainder = $num1 % $num2;

            if ($this->hasRemainder) {
                $answer = (object)[
                    'product' => $product,
                    'remainder' => $remainder
                ];
            } else {
                $num1 = $num2 * $product;

                $answer = (object)[
                    'product' => $product,
                    'remainder' => 0
                ];
            }

            $quizzes[] = (object)[
                'num1' => $num1,
                'num2' => $num2,
                'answer' => $answer,
            ];
        }
        return $quizzes;
    }
}
