<?php

namespace App\Models\Solutions;

use App\Traits\Randoms;
use App\View\Components\Solutions\DivisionNikhilam as DivisionNikhilamSolution;
use stdClass;

class DivisionNikhilam extends SolutionAbstract
{
    use Randoms;

    
    public function __construct($level, $difficulty)
    {
        $this->level = $level;
        $this->difficulty = $difficulty;
    }

    private function defineNumber(): self
    {
        switch ($this->level) {
            case 'p4-6':
                $this->setMinMaxNum1(3, 3);
                $this->setMinMaxNum2(2, 2);
                break;
            case 'm1-3':
                $this->setMinMaxNum1(4, 6);
                $this->setMinMaxNum2(2, 4);
                break;
            default:
                $this->setMinMaxNum1(3, 3);
                $this->setMinMaxNum2(2, 2);
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
        $difficultyMap = [
            'easy' => [
                'fixDigits1' => [0, 1, 2, 3, 4, 5, 6],
                'fixDigits2' => [8, 9]
            ],
            'hard' => [
                'fixDigits1' => [4, 5, 6, 7, 8, 9],
                'fixDigits2' => [6, 7, 8, 9]
            ],
            'default' => [
                'fixDigits1' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                'fixDigits2' => [7, 8, 9]
            ]
        ];

        $difficulty = $difficultyMap[$this->difficulty] ?? $difficultyMap['default'];
        $fixDigits1 = $difficulty['fixDigits1'];
        $fixDigits2 = $difficulty['fixDigits2'];

        $length = mt_rand($this->minDigitNum2, $this->maxDigitNum2);
        $num2 = $this->generateRandomNumber($length, $fixDigits2);

        if ($this->level === 'm1-3') {
            do {
                $length = mt_rand($this->minDigitNum1, $this->maxDigitNum1);
                $num1 = $this->generateRandomNumber($length, $fixDigits1);
            } while ($num2 >= $num1 || floor($num1 / $num2) === 0);
        } else {
            do {
                $multiplier = mt_rand(2, intval((10 ** ($this->maxDigitNum1) - 1) / $num2));
                $num1 = $num2 * $multiplier;
            } while ($num1 < 10 ** ($this->minDigitNum1 - 1) || $num1 > 10 ** $this->maxDigitNum1 - 1);
        }


        return (object)['num1' => $num1, 'num2' => $num2];
    }


    public function get(int $numItems): array
    {
        //ระบุจำนวนหลักตามระดับ
        $this->defineNumber();
        //สุ่มเลขตามระดับความยาก
        $quizzes = [];
        for ($i = 0; $i < $numItems; $i++) {
            $quiz = $this->rand();
            $divNikhilam = new DivisionNikhilamSolution($quiz->num1, $quiz->num2,0,false);
            $quiz->more = $divNikhilam->isMoreThreeTables;
            $quiz->three=$divNikhilam->isThreeTables;

            if($i%4>1){
                if($quiz->three){
                    $i--;
                    continue;
                }
            }

            $quizzes[] = $quiz;
        }
        // dd($quizzes);
        //ส่งออกในรูปอะเรย์
        return $quizzes;
    }
}
