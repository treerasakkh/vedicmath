<?php

namespace App\Models\Solutions;

use stdClass;

class AdditionSubtractionMixed extends SolutionAbstract
{
    private $minDigits;
    private $maxDigits;
    private $total;
    public function __construct($level, $difficulty)
    {
        $this->level = $level;
        $this->difficulty = $difficulty;
    }
    private function start(): stdClass
    {
        switch ($this->level) {
            case 'p4-6':
                $this->minDigits = 3;
                $this->maxDigits = 4;
                $this->total = 4;
                break;
            case 'm1-3':
                $this->minDigits = 4;
                $this->maxDigits = 6;
                $this->total = 4;
                break;
            default:
                $this->minDigits = 2;
                $this->maxDigits = 3;
                $this->total = 4;
        }

        $numbers = $this->generateNumbers($this->minDigits, $this->maxDigits, $this->difficulty);
        return (object)['numbers' => $numbers];
    }

    private function generateNumber($minDigits, $maxDigits, $difficulty)
    {
        $digits = rand($minDigits, $maxDigits);
        $number = '';

        if ($difficulty == 'easy') {
            $number .= rand(1, 7);
        } elseif ($difficulty == 'hard') {
            $number .= rand(4, 9);
        } else {
            $number .= rand(1, 9);
        }

        for ($i = 1; $i < $digits; $i++) {
            if ($difficulty == 'easy') {
                $number .= rand(0, 7);
            } elseif ($difficulty == 'hard') {
                $number .= rand(4, 9);
            } else {
                $number .= rand(0, 9);
            }
        }

        return (int)$number;
    }
    private function generateNumbers()
    {
        $numbers = [];
        $sum = 0;


        // Generate first number (always positive)
        $firstNumber = $this->generateNumber($this->minDigits, $this->maxDigits, $this->difficulty);
        $numbers[] = $firstNumber;
        $sum += $firstNumber;

        // Generate the next three numbers
        for ($i = 1; $i < 4; $i++) {
            $number = $this->generateNumber($this->minDigits, $this->maxDigits, $this->difficulty);
            $numbers[] = $number;
            $sum += $number;
        }

        // Ensure at least one number (besides the first) is negative
        $negativeIndex = rand(1, 3);
        $numbers[$negativeIndex] = -$numbers[$negativeIndex];
        $sum += 2 * $numbers[$negativeIndex]; // Correct the sum by adding the negative twice

        // Adjust the sum to be positive if necessary
        while ($sum <= 0) {
            $adjustmentIndex = rand(1, 3);
            if ($numbers[$adjustmentIndex] < 0) {
                $sum += -2 * $numbers[$adjustmentIndex]; // Revert the negative effect
                $numbers[$adjustmentIndex] = -$numbers[$adjustmentIndex];
            } else {
                $numbers[$adjustmentIndex] = -$numbers[$adjustmentIndex];
                $sum += 2 * $numbers[$adjustmentIndex]; // Apply the negative effect
            }
        }

        return $numbers;
    }

    // Private helper function to generate a number based on difficulty
    private function generateNumberBasedOnDifficulty($numDigits, $difficulty, $isFirstNumber = false)
    {
        $number = '';
        for ($i = 0; $i < $numDigits; $i++) {
            switch ($difficulty) {
                case 'easy':
                    $digit = rand(0, 6);
                    break;
                case 'hard':
                    $digit = rand(4, 9);
                    break;
                default:
                    $digit = rand(0, 9);
                    break;
            }
            $number .= $digit;
        }

        return $isFirstNumber ? abs(intval($number)) : intval($number);
    }



    public function get(int $numItems): array
    {
        //ระบุจำนวนหลักตามระดับ
        //สุ่มเลขตามระดับความยาก
        $quizzes = [];
        for ($i = 0; $i < $numItems; $i++) {
            $quizzes[] = $this->start();
        }
        //ส่งออกในรูปอะเรย์
        return $quizzes;
    }
}
