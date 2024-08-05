<?php

namespace App\Models\Solutions;

use stdClass;

class SubtractionTenNine extends SolutionAbstract
{
    public function __construct($level, $difficulty)
    {
        $this->level = $level;
        $this->difficulty = $difficulty;
    }
    private function defineNumber(): self
    {
        switch ($this->level) {
            case 'p4-6':
                $this->setMinMaxNum1(5, 7);
                $this->setMinMaxNum2(5, 7);
                break;
            case 'm1-3':
                $this->setMinMaxNum1(6, 8);
                $this->setMinMaxNum2(6, 8);
                break;
            default:
                $this->setMinMaxNum1(3, 3);
                $this->setMinMaxNum2(3, 3);
        }
        return $this;
    }

    private function setMinMaxNum1(int $min, int $max): self
    {
        $this->minDigitNum1 = $min;
        $this->maxDigitNum1 = $max;
        return $this;
    }
    private function setMinMaxNum2(int $min, int $max): self
    {
        $this->minDigitNum2 = $min;
        $this->maxDigitNum2 = $max;
        return $this;
    }

    private function rand(): stdClass
    {
        switch ($this->difficulty) {
            case 'easy':
                $fixDigits1 =[mt_rand(1,4),5,6,7,8,9];
                $fixDigits2=[0,1,2,3,4,5,6,mt_rand(7,8)];
                break;
            case 'hard':
                $fixDigits1 =[0,1,2,3,4,5,6];
                $fixDigits2=[4,5,6,7,8,9];
                break;
            default:
            $fixDigits1 =[0,1,2,3,4,5,6,7,8,9];
            $fixDigits2=[0,1,2,3,4,5,6,7,8,9];
        }


        list($num1,$num2) = $this->getRandomNumbers($this->minDigitNum1, $this->maxDigitNum1,$this->minDigitNum2, $this->maxDigitNum2,$fixDigits1,$fixDigits2);

        $answer = $num1 - $num2;
        return (object)['num1' => $num1, 'num2' => $num2, 'answer' => $answer];
    }

    public function get(int $numItems): array
    {
        //ระบุจำนวนหลักตามระดับ
        $this->defineNumber();
        //สุ่มเลขตามระดับความยาก
        $quizzes = [];
        for ($i = 0; $i < $numItems; $i++) {
            $quizzes[] = $this->rand();
        }
        //ส่งออกในรูปอะเรย์
        return $quizzes;
    }
}
